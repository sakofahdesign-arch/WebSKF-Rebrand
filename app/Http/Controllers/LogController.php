<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

class LogController extends Controller
{
    public function index(Request $request)
    {
        // 1. ค้นหาไฟล์ Log ทั้งหมดที่ขึ้นต้นด้วย laravel-
        $files = glob(storage_path('logs/laravel-*.log'));
        
        // 2. เรียงลำดับจากใหม่ไปเก่า
        rsort($files);

        // 3. เตรียมข้อมูลสำหรับ Dropdown เลือกวันที่
        $fileList = [];
        foreach ($files as $filePath) {
            $filename = basename($filePath);
            // ดึงวันที่จากชื่อไฟล์ (laravel-2024-01-20.log -> 2024-01-20)
            if (preg_match('/laravel-(\d{4}-\d{2}-\d{2})\.log/', $filename, $matches)) {
                $fileList[$matches[1]] = $filename;
            }
        }

        // 4. หาวันที่ที่ต้องการดู (ถ้าไม่ส่งมา ให้เอาอันล่าสุด)
        $currentDate = $request->get('date');
        if (!$currentDate || !isset($fileList[$currentDate])) {
            $currentDate = array_key_first($fileList);
        }

        $currentFile = $fileList[$currentDate] ?? null;
        $logs = "";

        // 5. อ่านไฟล์
        if ($currentFile) {
            $path = storage_path('logs/' . $currentFile);
            if (File::exists($path)) {
                // ถ้าไฟล์ใหญ่เกิน 2MB ให้อ่านแค่ 2000 บรรทัดท้าย
                if (File::size($path) > 2000000) {
                    $lines = file($path);
                    $logs = implode("", array_slice($lines, -2000));
                    $logs = "--- (ไฟล์มีขนาดใหญ่ แสดงเฉพาะ 2000 บรรทัดล่าสุด) ---\n" . $logs;
                } else {
                    $logs = File::get($path);
                }
            }
        }

        return view('office.admin.logs.index', compact('fileList', 'currentDate', 'currentFile', 'logs'));
    }

    public function download(Request $request)
    {
        $filename = $request->get('file');
        $path = storage_path('logs/' . $filename);

        if (File::exists($path)) {
            return Response::download($path);
        }
        return back()->with('error', 'ไม่พบไฟล์ดังกล่าว');
    }

    public function delete(Request $request)
    {
        $filename = $request->get('file');
        $path = storage_path('logs/' . $filename);

        if (File::exists($path)) {
            File::delete($path);
            return redirect()->route('admin.logs')->with('success', 'ลบไฟล์ Log เรียบร้อยแล้ว');
        }
        return back()->with('error', 'ไม่สามารถลบไฟล์ได้');
    }
}