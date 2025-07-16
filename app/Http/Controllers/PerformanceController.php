<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PerformanceController extends Controller
{
    public function index()
    {
        $data = DB::table('performance')->get();
        return view('office.performance.index', compact('data'));
    }

    public function add_performance()
    {
        return view('office.performance.create');
    }

    public function postPerformance(Request $request)
    {
        // 1. ตรวจสอบความถูกต้องของข้อมูล
        $request->validate([
            'document_name' => 'required|string|max:255',
            'documentFile'  => 'required|file|mimes:pdf,doc,docx,xls,xlsx|max:20480', // รับไฟล์ pdf, word, excel ไม่เกิน 20MB
        ]);

        // 2. จัดการไฟล์ที่อัปโหลด
        $file = $request->file('documentFile');

        // สร้างชื่อไฟล์ใหม่ที่ไม่ซ้ำกัน โดยใช้ชื่อเอกสารตามด้วย timestamp
        $fileName = Str::slug($request->document_name) . '_' . time() . '.' . $file->getClientOriginalExtension();

        // กำหนดโฟลเดอร์ที่จะเก็บไฟล์
        $uploadPath = 'file/performance';

        // ย้ายไฟล์ไปยังโฟลเดอร์ที่กำหนด
        $file->move(public_path($uploadPath), $fileName);

        // 3. บันทึกข้อมูลลงฐานข้อมูล
        DB::table('performance')->insert([
            'document_name' => $request->document_name,
            'file_name'     => $fileName,
            'date'          => now(), // บันทึกวันที่ปัจจุบัน
        ]);

        // 4. Redirect กลับไปหน้าเดิม พร้อมข้อความแจ้งเตือน
        return back()->with('success', 'อัปโหลดเอกสารเรียบร้อยแล้ว');
    }

}
