<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CreditController extends Controller
{
    public function searchcredit(Request $request)
    {
        // --- ส่วนของการค้นหาข้อมูล ---
        $query = DB::table('credit_upload')
            ->join('credit_type', 'credit_type.credit_id', '=', 'credit_upload.credit_id')
            ->join('branch_name', 'branch_name.branch_id', '=', 'credit_upload.branch_id');

        // ตรวจสอบว่ามีการส่งข้อมูลมาเพื่อค้นหาหรือไม่
        if ($request->isMethod('get') && $request->hasAny(['year', 'branch_id', 'credit_id', 'mem_id'])) {

            if ($request->filled('year')) {
                $query->where('credit_upload.year', $request->year);
            }

            if ($request->filled('branch_id')) {
                $query->where('credit_upload.branch_id', $request->branch_id);
            }

            if ($request->filled('id')) {
                $query->where('credit_upload.id', $request->credit_id);
            }

            if ($request->filled('mem_id')) {
                $query->where('credit_upload.mem_id', 'like', '%' . $request->mem_id . '%');
            }

            $data = $query->select(
                'credit_upload.id_credit',
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
                ->orderBy('credit_upload.date_upload', 'desc')
                ->paginate(15);

        } else {
            $data = new LengthAwarePaginator([], 0, 15);
        }

        return view('office.credits.searchcredit', compact('data'));
    }

    public function uploadcredit()
    {
        return view('office.credits.uploadcredit');
    }

    public function postcredit(Request $request)
    {
        $request->validate([
            'memberID'       => 'required|max:5',
            'firstName'      => 'required',
            'lastName'       => 'required',
            'contractNumber' => 'required',
            'contractYear'   => 'required',
            'branch'         => 'required',
            'contractType'   => 'required',
            'file'           => 'required|file|mimes:pdf,doc,docx|max:10240', // Max 10MB
        ]);

        $uploadedFile = $request->file('file');

        // 1. สร้าง Path สำหรับจัดเก็บไฟล์
        $path = 'file/credit_folder/' . $request->contractYear . '/' . $request->branch . '/' . $request->contractType;

        // 2. สร้างชื่อไฟล์ใหม่ที่ปลอดภัยและไม่ซ้ำกัน
        // ทำความสะอาดเลขที่สัญญาเพื่อใช้เป็นส่วนหนึ่งของชื่อไฟล์
        $safeContractNumber = Str::slug($request->contractNumber, '-');
        // เอานามสกุลไฟล์เดิมมาใช้
        $fileExtension = $uploadedFile->getClientOriginalExtension();
        // สร้างชื่อไฟล์ใหม่โดยใช้ เลขที่สัญญา + timestamp เพื่อป้องกันชื่อซ้ำ
        $newFileName = $safeContractNumber . '_' . time() . '.' . $fileExtension;

        // 3. ย้ายไฟล์ไปยัง Path ที่กำหนด
        // เมธอด move() จะสร้างโฟลเดอร์ให้โดยอัตโนมัติหากยังไม่มี
        if ($uploadedFile->move(public_path($path), $newFileName)) {

            $data = [
                'mem_id'      => $request->memberID,
                'fname'       => $request->firstName,
                'lname'       => $request->lastName,
                'fullcont_id' => $request->contractNumber,
                'branch_id'   => $request->branch,
                'credit_id'   => $request->contractType,
                'year'        => $request->contractYear,
                'file_name'   => $newFileName, // ใช้ชื่อไฟล์ใหม่ที่สร้างขึ้น
                'path'        => $path,
                'name_upload' => session('username'),
                'date_upload' => date('Y-m-d'),
            ];

            DB::table('credit_upload')->insert($data);

            return redirect()->back()->with('success', 'อัพโหลดไฟล์สำเร็จ');
        } else {
            return redirect()->back()->with('error', 'เกิดข้อผิดพลาด ไม่สามารถอัพโหลดไฟล์ได้');
        }

    }
}
