<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class AssetController extends Controller
{
    public function index()
    {
        $assets = DB::table('asset')->join('asset_type', 'asset.asset_type', '=', 'asset_type.asset_type')->paginate(10);
        return view('office.admin.assets.index', compact('assets'));
    }

    public function create()
    {
        return view('office.admin.assets.create');
    }

    public function store(Request $request)
    {
        // 1. ตรวจสอบข้อมูลเบื้องต้น
        $request->validate([
            'title'      => 'required|string|max:255',
            'asset_type' => 'required|integer',
            'coverImage' => 'required|image',
            'Images'     => 'required|array',
            'Images.*'   => 'image',
        ]);

        // 2. บันทึกข้อมูลที่เป็นข้อความลงตาราง asset และเอา ID ที่สร้างใหม่มาใช้
        // เราจะใส่ picture_name เป็นค่าว่างไว้ก่อน
        $asset_id = DB::table('asset')->insertGetId([
            'title'        => $request->title,
            'description1' => $request->description1 ?? '',
            'description2' => $request->description2 ?? '',
            'contact'      => $request->contact ?? '',
            'asset_type'   => $request->asset_type,
            'picture_name' => '', // <-- ค่าว่างชั่วคราว
            'date'         => now(),
        ]);

        // 3. กำหนดโฟลเดอร์ที่จะเก็บรูปทั้งหมด
        $uploadFolder = 'assets';
        $timestamp    = time(); // ใช้ timestamp เพื่อป้องกันชื่อซ้ำ

        // 4. จัดการ "ภาพหน้าปก" (Cover Image)
        if ($request->hasFile('coverImage')) {
            $coverFile = $request->file('coverImage');
            $extension = $coverFile->getClientOriginalExtension();

            // สร้างชื่อไฟล์ใหม่ -> asset_[ID]_cover_[timestamp].ext
            $coverFileName = "{$asset_id}_cover_{$timestamp}.{$extension}";

            // ย้ายไฟล์ไปเก็บ
            $coverFile->move(public_path($uploadFolder), $coverFileName);

            // อัปเดตชื่อไฟล์ภาพหน้าปกกลับไปที่ตาราง asset
            DB::table('asset')->where('id', $asset_id)->update(['picture_name' => $coverFileName]);
        }

        // 5. จัดการ "รูปประกอบ" (Gallery Images)
        if ($request->hasFile('Images')) {
            foreach ($request->file('Images') as $index => $galleryFile) {
                $extension = $galleryFile->getClientOriginalExtension();

                // สร้างชื่อไฟล์ใหม่ -> asset_[ID]_gallery_[timestamp]_[ลำดับ].ext
                $galleryFileName = "{$asset_id}_gallery_{$timestamp}_" . ($index + 1) . ".{$extension}";

                // ย้ายไฟล์
                $galleryFile->move(public_path($uploadFolder), $galleryFileName);

                // บันทึกข้อมูลลงตาราง asset_picture
                DB::table('asset_picture')->insert([
                    'id' => $asset_id,
                    'picture_name' => $galleryFileName,
                ]);
            }
        }

        // 6. เมื่อเสร็จสิ้น ให้ redirect กลับไปพร้อมข้อความแจ้งเตือน
        return redirect()->route('asset.index')->with('success', 'เพิ่มสินทรัพย์เรียบร้อยแล้ว');
    }

    // 1. ฟังก์ชันสำหรับแสดงหน้าแก้ไข
    public function edit($id)
    {
        $asset = DB::table('asset')->where('id', $id)->first();

        if (! $asset) {
            return redirect()->route('asset.index')->with('error', 'ไม่พบสินทรัพย์ที่ต้องการแก้ไข');
        }

        // ส่งข้อมูลสินทรัพย์ไปที่หน้า view
        return view('office.admin.assets.edit', compact('asset'));
    }

// 2. ฟังก์ชันสำหรับอัปเดตข้อมูล (รับข้อมูลจากฟอร์ม)
    public function update(Request $request, $id)
    {
        $request->validate([
            'title'        => 'required|string|max:255',
            'description1' => 'required|string',
            'description2' => 'required|string',
            'contact'      => 'required|string',
            'asset_type'   => 'required|integer',
        ]);

        DB::table('asset')->where('id', $id)->update([
            'title'        => $request->title,
            'description1' => $request->description1,
            'description2' => $request->description2,
            'contact'      => $request->contact,
            'asset_type'   => $request->asset_type,
        ]);

        return redirect()->route('asset.index')->with('success', 'แก้ไขข้อมูลสินทรัพย์เรียบร้อยแล้ว');
    }

// 3. ฟังก์ชันสำหรับลบข้อมูลและไฟล์ทั้งหมด
    public function destroy($id)
    {
        $asset = DB::table('asset')->where('id', $id)->first();
        if (! $asset) {
            return redirect()->route('asset.index')->with('error', 'ไม่พบสินทรัพย์ที่ต้องการลบ');
        }

        $uploadFolder = 'assets';

        // ดึงชื่อไฟล์รูปภาพทั้งหมดที่เกี่ยวข้อง
        $coverImage    = $asset->picture_name;
        $galleryImages = DB::table('asset_picture')->where('id', $id)->pluck('picture_name');

        // เริ่มลบข้อมูลในฐานข้อมูล (ใช้ Transaction เพื่อความปลอดภัย)
        try {
            DB::transaction(function () use ($id) {
                DB::table('asset_picture')->where('id', $id)->delete();
                DB::table('asset')->where('id', $id)->delete();
            });

            // หากลบข้อมูลสำเร็จ ให้ลบไฟล์รูปภาพออกจาก server
            if ($coverImage) {
                File::delete(public_path($uploadFolder . '/' . $coverImage));
            }
            foreach ($galleryImages as $image) {
                File::delete(public_path($uploadFolder . '/' . $image));
            }

            return redirect()->route('asset.index')->with('success', 'ลบสินทรัพย์และรูปภาพทั้งหมดเรียบร้อยแล้ว');

        } catch (\Throwable $e) {
            return redirect()->route('asset.index')->with('error', 'เกิดข้อผิดพลาดในการลบข้อมูล');
        }
    }
}
