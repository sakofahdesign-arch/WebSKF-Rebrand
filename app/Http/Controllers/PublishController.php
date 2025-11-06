<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File; // ใช้ Storage Facade
use Illuminate\Support\Str;

class PublishController extends Controller
{
    /**
     * 1. แสดงหน้าแรก (รายการประกาศทั้งหมด)
     */
    public function index()
    {
        $announcements = DB::table('internal_announcement')
            ->orderBy('date', 'desc')
            ->paginate(10);

        // เพิ่มการตรวจสอบไฟล์ก่อนส่งไป view
        $announcements->map(function ($item) {
            $filePath          = public_path('file/inside_publish/' . $item->uploadfile);
            $item->file_exists = file_exists($filePath) && ! empty($item->uploadfile);
            return $item;
        });

        return view('office.admin.announcements.index', ['announcements' => $announcements]);
    }

    /**
     * 2. แสดงหน้าฟอร์มสำหรับ "เพิ่ม" ประกาศใหม่
     */
    public function create()
    {
        return view('office.admin.announcements.create');
    }

    /**
     * 3. จัดการการ "บันทึก" ประกาศใหม่
     */
    public function store(Request $request)
    {
        $request->validate([
            'type_announcement' => 'required|string|max:255',
            'title'             => 'required|string|max:255',
            'uploadfile'        => 'required|file|mimes:pdf,doc,docx,xls,xlsx,jpg,png|max:10240',
        ]);

        $file       = $request->file('uploadfile');
        $uploadPath = 'file/inside_publish'; // ✨ กำหนด path ที่จะเก็บไฟล์

        // ✨ สร้างชื่อไฟล์ใหม่ -> [ชื่อเรื่องแบบไม่มีเว้นวรรค]_[เวลา].ext
        $fileName = Str::slug($request->title) . '_' . time() . '.' . $file->getClientOriginalExtension();

        // ย้ายไฟล์ไปที่ public/file/inside_publish
        $file->move(public_path($uploadPath), $fileName);

        DB::table('internal_announcement')->insert([
            'type_announcement' => $request->type_announcement,
            'title'             => $request->title,
            'uploadfile'        => $fileName, // ✨ เก็บแค่ชื่อไฟล์
            'date'              => now(),
        ]);

        return redirect()->route('announcements.index')->with('success', 'เพิ่มประกาศใหม่เรียบร้อยแล้ว');
    }

    /**
     * 4. แสดงหน้าฟอร์มสำหรับ "แก้ไข" ประกาศ
     */
    public function edit($id)
    {
        $announcement = DB::table('internal_announcement')->find($id);
        if (! $announcement) {
            return redirect()->route('announcements.index')->with('error', 'ไม่พบประกาศที่ต้องการแก้ไข');
        }
        return view('office.admin.announcements.edit', ['announcement' => $announcement]);
    }

    /**
     * 5. จัดการการ "อัปเดต" ข้อมูลที่แก้ไข
     */
    public function update(Request $request, $id)
    {
        $announcement = DB::table('internal_announcement')->find($id);
        if (! $announcement) {
            return redirect()->route('announcements.index')->with('error', 'ไม่พบประกาศ');
        }

        $request->validate([
            'type_announcement' => 'required|string|max:255',
            'title'             => 'required|string|max:255',
            'uploadfile'        => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,jpg,png|max:10240',
        ]);

        $uploadPath = 'file/inside_publish';
        $data       = [
            'type_announcement' => $request->type_announcement,
            'title'             => $request->title,
        ];

        if ($request->hasFile('uploadfile')) {
            // ✨ ลบไฟล์เก่า ถ้ามี
            if ($announcement->uploadfile) {
                File::delete(public_path($uploadPath . '/' . $announcement->uploadfile));
            }

            $file = $request->file('uploadfile');
            // ✨ สร้างชื่อไฟล์ใหม่และย้ายไฟล์
            $fileName = Str::slug($request->title) . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path($uploadPath), $fileName);
            $data['uploadfile'] = $fileName; // อัปเดตชื่อไฟล์ใหม่
        }

        DB::table('internal_announcement')->where('id', $id)->update($data);

        return redirect()->route('announcements.index')->with('success', 'แก้ไขประกาศเรียบร้อยแล้ว');
    }

    /**
     * 6. จัดการการ "ลบ" ประกาศ
     */
    public function destroy($id)
    {
        $announcement = DB::table('internal_announcement')->find($id);
        if ($announcement) {
            // ✨ ลบไฟล์ออกจากโฟลเดอร์ที่ถูกต้อง
            if ($announcement->uploadfile) {
                File::delete(public_path('file/inside_publish/' . $announcement->uploadfile));
            }
            DB::table('internal_announcement')->where('id', $id)->delete();
            return redirect()->route('announcements.index')->with('success', 'ลบประกาศเรียบร้อยแล้ว');
        }
        return redirect()->route('announcements.index')->with('error', 'เกิดข้อผิดพลาดในการลบ');
    }
}
