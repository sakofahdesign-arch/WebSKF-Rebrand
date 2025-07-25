<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class CreditController extends Controller
{
    public function searchcredit(Request $request)
    {
        // สร้าง Query Builder สำหรับตาราง credit_upload และ join ตารางที่เกี่ยวข้อง
        $query = DB::table('credit_upload')->join('credit_type', 'credit_type.credit_id', '=', 'credit_upload.credit_id')->join('branch_name', 'branch_name.branch_id', '=', 'credit_upload.branch_id');

        // เก็บพารามิเตอร์ทั้งหมดจาก Request ยกเว้น 'page'
        // เพื่อนำไปใช้กับลิงก์ pagination ให้คงค่าการค้นหาไว้
        $searchParams = $request->except('page');

        // กำหนดตัวแปร $data ให้เป็น LengthAwarePaginator ที่ว่างเปล่าเป็นค่าเริ่มต้น
        // เพื่อให้เมื่อเข้าหน้าครั้งแรกโดยไม่มีการค้นหา จะไม่แสดงข้อมูลใดๆ
        $data = new LengthAwarePaginator([], 0, 15);

        // ตรวจสอบว่ามีการกดปุ่มค้นหาหรือไม่
        // โดยเช็คว่ามีพารามิเตอร์การค้นหาใดๆ อยู่ใน Request หรือไม่
        // (แม้ว่าค่าจะเป็นสตริงว่างเปล่าก็ตาม)
        $isSearchTriggered = $request->has('year') ||
        $request->has('branch_id') ||
        $request->has('credit_id') ||
        $request->has('mem_id');

        // หากมีการกดปุ่มค้นหา (isSearchTriggered เป็น true)
        // หรือหากเป็นการกดลิงก์ pagination (มีพารามิเตอร์ 'page')
        if ($isSearchTriggered || $request->has('page')) {

            // ตรวจสอบและเพิ่มเงื่อนไขการค้นหาตามที่ผู้ใช้กรอก
            // จะเพิ่มเงื่อนไข where ก็ต่อเมื่อช่องนั้นๆ มีข้อมูล (filled)
            if ($request->filled('year')) {
                $query->where('credit_upload.year', $request->input('year'));
            }

            if ($request->filled('branch_id')) {
                $query->where('credit_upload.branch_id', $request->input('branch_id'));
            }

            if ($request->filled('credit_id')) {
                // ใช้ credit_upload.credit_id เนื่องจากเป็นคอลัมน์ประเภทสัญญาตามโครงสร้างตาราง
                $query->where('credit_upload.credit_id', $request->input('credit_id'));
            }

            if ($request->filled('mem_id')) {
                // ใช้ 'like' สำหรับการค้นหาบางส่วนของเลขสมาชิก
                $query->where('credit_upload.mem_id', 'like', '%' . $request->input('mem_id') . '%');
            }

            // ดึงข้อมูลที่เลือกทั้งหมด พร้อมเรียงลำดับและแบ่งหน้า
            $data = $query->select(
                'credit_upload.id', // แก้ไขจาก 'id' เป็น 'id_credit' ตามโครงสร้างตาราง
                'credit_upload.mem_id',
                'credit_upload.fname',
                'credit_upload.lname',
                'credit_upload.fullcont_id',
                'credit_upload.path',
                'credit_upload.file_name',
                'credit_upload.name_upload',
                'credit_upload.date_upload',
                'credit_upload.year',
                'branch_name.name_branch',
                'credit_type.credit_name'
            )
                ->orderBy('credit_upload.date_upload', 'desc') // เรียงตามวันที่อัปโหลดล่าสุด
                ->paginate(15)                                 // แบ่งหน้า 15 รายการต่อหน้า
                ->appends($searchParams);                      // แนบพารามิเตอร์การค้นหาไปกับลิงก์ pagination
        }
        // หาก $isSearchTriggered เป็น false และ $request->has('page') เป็น false
        // (คือการเข้าหน้าครั้งแรกโดยไม่มีพารามิเตอร์ใดๆ)
        // $data จะยังคงเป็น LengthAwarePaginator ที่ว่างเปล่าตามที่กำหนดไว้ตอนต้น

        // ส่งข้อมูลไปยัง View
        return view('office.credits.searchcredit', compact('data'));
    }

    public function uploadcredit()
    {
        return view('office.credits.uploadcredit');
    }

    public function postcredit(Request $request)
    {
        $messages = [
            'memberID.required'       => 'กรุณาระบุรหัสสมาชิก',
            'memberID.max'            => 'รหัสสมาชิกต้องไม่เกิน 5 ตัวอักษร',
            'firstName.required'      => 'ใส่ชื่อด้วย',
            'lastName.required'       => 'ใส่นามสกุลด้วย',
            'contractNumber.required' => 'กรุณาระบุเลขที่สัญญา',
            'contractYear.required'   => 'กรุณาระบุปีสัญญา',
            'branch.required'         => 'กรุณาเลือกสาขา',
            'contractType.required'   => 'กรุณาเลือกประเภทสัญญา',
            'file.required'           => 'กรุณาแนบไฟล์',
            'file.file'               => 'ไฟล์ไม่ถูกต้อง',
            'file.mimes'              => 'ไฟล์ต้องเป็น pdf, doc หรือ docx เท่านั้น',
            'file.max'                => 'ไฟล์ขนาดไม่เกิน 10MB',
        ];

        // ใช้ Validator::make แทน $request->validate เพื่อควบคุม error เอง
        $validator = Validator::make($request->all(), [
            'memberID'       => 'required|max:5',
            'firstName'      => 'required',
            'lastName'       => 'required',
            'contractNumber' => 'required',
            'contractYear'   => 'required',
            'branch'         => 'required',
            'contractType'   => 'required',
            'file'           => 'required|file|mimes:pdf,doc,docx|max:10240',
        ], $messages);

        if ($validator->fails()) {
            $errorMessages = implode('<br>', $validator->errors()->all());
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', $errorMessages);
        }

        $uploadedFile       = $request->file('file');
        $storagePath        = 'file/credit_folder/';
        $safeContractNumber = preg_replace('/[^A-Za-z0-9\-]/', '_', $request->input('contractNumber'));
        $fileExtension      = $uploadedFile->getClientOriginalExtension();
        $newFileName        = $safeContractNumber . '_' . time() . '.' . $fileExtension;
        if (! file_exists(public_path($storagePath))) {
            mkdir(public_path($storagePath), 0755, true);
        }
        if ($uploadedFile->move(public_path($storagePath), $newFileName)) {
            $data = [
                'mem_id'      => $request->input('memberID'),
                'fname'       => $request->input('firstName'),
                'lname'       => $request->input('lastName'),
                'fullcont_id' => $request->input('contractNumber'),
                'branch_id'   => $request->input('branch'),
                'credit_id'   => $request->input('contractType'),
                'year'        => $request->input('contractYear'),
                'file_name'   => $newFileName,
                'path'        => $storagePath,
                'name_upload' => session('username'),
                'date_upload' => now()->toDateString(),
            ];
            DB::table('credit_upload')->insert($data);
            return redirect()->back()->with('success', 'อัพโหลดไฟล์สำเร็จ');
        } else {
            Log::error('File upload failed', ['file_name' => $uploadedFile->getClientOriginalName(), 'destination' => public_path($storagePath)]);
            return redirect()->back()->with('error', 'เกิดข้อผิดพลาด ไม่สามารถอัพโหลดไฟล์ได้');
        }
    }

    public function index()
    {
        $credits = DB::table('credit_upload')
            ->join('credit_type', 'credit_upload.credit_id', '=', 'credit_type.credit_id')
            ->join('branch_name', 'credit_upload.branch_id', '=', 'branch_name.branch_id')
            ->get();
        foreach ($credits as $credit) {
            $filePath            = public_path('file/credit_folder/' . $credit->file_name);
            $credit->file_exists = $credit->file_name && File::exists($filePath);
        }
        return view('office.credits.index', compact('credits'));
    }

    public function destroy($id)
    {
        $credit = DB::table('credit_upload')->where('id', $id)->first();

        $filePath = public_path('file/credit_folder/' . $credit->file_name);
        if (File::exists($filePath)) {
            File::delete($filePath);
        }

        DB::table('credit_upload')->where('id', $id)->delete();

        return redirect()->back()->with('success', 'ลบข้อมูลเรียบร้อยแล้ว');
    }

}
