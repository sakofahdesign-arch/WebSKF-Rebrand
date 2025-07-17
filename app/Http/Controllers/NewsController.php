<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
// Import Log facade for error logging

// Import File facade for deleting old images

class NewsController extends Controller
{
    public function index()
    {
        $data = DB::table('news')->join('news_type', 'news.news_typeid', '=', 'news_type.news_typeid')
            ->select('title', 'news_typename', 'dateupload', 'news_number', 'news_number')->orderByDesc('dateupload')
            ->paginate(15);
        return view('office.news.index', compact('data'));
    }

    public function create()
    {
        return view('office.news.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'title'           => 'required|string|max:255',
            'news_type'       => 'required',
            'date'            => 'required|date',
            'description'     => 'required|string',
            'coverImage'      => 'required|image|mimes:jpeg,png,jpg,gif', // 50MB
            'uploadedFiles.*' => 'nullable|image|mimes:jpeg,png,jpg,gif', // Gallery images are optional
        ]);

        do {
            $news_number = mt_rand(10000, 99999);
        } while (DB::table('news')->where('news_number', $news_number)->exists());

        $coverImage       = $request->file('coverImage');
        $coverPath        = 'uploads/covers';
        $hashedCoverImage = $news_number . '_' . date('Ymd') . '.' . $coverImage->getClientOriginalExtension();
        $coverImage->move(public_path($coverPath), $hashedCoverImage);
        DB::table('news')->insert([
            'news_number'  => $news_number,
            'title'        => $request->title,
            'news_typeid'  => $request->news_type,
            'dateupload'   => $request->date,
            'description'  => $request->description,
            'path'         => $coverPath,
            'picture_name' => $hashedCoverImage,
        ]);

        if ($request->hasFile('uploadedFiles')) {
            $galleryPath = 'uploads/galleries';

            foreach ($request->file('uploadedFiles') as $index => $file) {
                $hashedFileName = $news_number . '_' . date('Ymd') . '_gallery_' . ($index + 1) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path($galleryPath), $hashedFileName);

                DB::table('picture')->insert([
                    'news_number'  => $news_number,
                    // 'path'         => $galleryPath,  **หมายเหตุ:** แนะนำให้มีคอลัมน์ path ในตาราง picture
                    'picture_name' => $hashedFileName,
                ]);
            }
        }

        return redirect()->route('news.index')->with('success', 'อัพโหลดข่าวสารสำเร็จ');
    }

    public function edit($news_number)
    {
        // 1. ดึงข้อมูลข่าวที่ต้องการแก้ไขจากฐานข้อมูล
        $news = DB::table('news')->where('news_number', $news_number)->first();

        // ถ้าไม่พบข่าว ให้ Redirect กลับไปพร้อมข้อความแจ้งเตือน
        if (! $news) {
            return redirect()->route('news.index')->with('error', 'ไม่พบข่าวที่ต้องการแก้ไข');
        }

        // 2. ดึงข้อมูลรูปภาพประกอบจากตาราง picture
        $pictures = DB::table('picture')->where('news_number', $news_number)->get();

        // 3. ส่งข้อมูลไปยัง View
        return view('office.news.edit', [
            'news'     => $news,
            'pictures' => $pictures,
        ]);
    }

    /**
     * Update the specified news item in storage.
     */
    public function update(Request $request, $news_number)
    {
        // 1. ตรวจสอบความถูกต้องของข้อมูล
        $request->validate([
            'title'           => 'required|string|max:255',
            'news_type'       => 'required',
            'date'            => 'required|date',
            'description'     => 'required|string',
            'coverImage'      => 'nullable|image|mimes:jpeg,png,jpg,gif', // ภาพหน้าปกใหม่ (ไม่บังคับ)
            'uploadedFiles.*' => 'nullable|image|mimes:jpeg,png,jpg,gif', // รูปประกอบใหม่ (ไม่บังคับ)
        ]);

        // 2. ค้นหาข้อมูลข่าวเดิม
        $existing_news = DB::table('news')->where('news_number', $news_number)->first();
        if (! $existing_news) {
            return redirect()->back()->with('error', 'ไม่พบข่าวที่ต้องการอัปเดต');
        }

        $coverImagePath = $existing_news->path . '/' . $existing_news->picture_name;

        // 3. จัดการอัปโหลด "ภาพหน้าปก" ใหม่ (ถ้ามี)
        if ($request->hasFile('coverImage')) {
            // ลบไฟล์ภาพหน้าปกเก่า (ถ้ามี)
            if (File::exists(public_path($coverImagePath))) {
                File::delete(public_path($coverImagePath));
            }

            $coverFile        = $request->file('coverImage');
            $coverPath        = 'uploads/covers';
            $hashedCoverImage = $news_number . '_' . date('YmdHis') . '.' . $coverFile->getClientOriginalExtension();
            $coverFile->move(public_path($coverPath), $hashedCoverImage);

            // อัปเดต Path และชื่อไฟล์ใหม่
            DB::table('news')->where('news_number', $news_number)->update([
                'path'         => $coverPath,
                'picture_name' => $hashedCoverImage,
            ]);
        }

        // 4. จัดการอัปโหลด "รูปภาพประกอบ" ใหม่ (ถ้ามี)
        // โดยจะลบของเก่าทั้งหมดก่อน แล้วจึงเพิ่มของใหม่เข้าไป
        if ($request->hasFile('uploadedFiles')) {
            // 4.1 ค้นหาและลบรูปภาพประกอบเก่าทั้งหมด
            $oldPictures = DB::table('picture')->where('news_number', $news_number)->get();
            foreach ($oldPictures as $pic) {
                // ลบไฟล์ออกจาก server
                if (File::exists(public_path('uploads/galleries/' . $pic->picture_name))) {
                    File::delete(public_path('uploads/galleries/' . $pic->picture_name));
                }
            }
            // ลบข้อมูลออกจากฐานข้อมูล
            DB::table('picture')->where('news_number', $news_number)->delete();

            // 4.2 อัปโหลดและบันทึกรูปภาพประกอบชุดใหม่
            $galleryPath = 'uploads/galleries';
            foreach ($request->file('uploadedFiles') as $index => $file) {
                $hashedFileName = $news_number . '_' . date('YmdHis') . '_gallery_' . ($index + 1) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path($galleryPath), $hashedFileName);

                // บันทึกข้อมูลลงในตาราง 'picture'
                DB::table('picture')->insert([
                    'news_number'  => $news_number,
                    'path'         => $galleryPath,
                    'picture_name' => $hashedFileName,
                ]);
            }
        }

        // 5. อัปเดตข้อมูลอื่นๆ ของข่าว
        DB::table('news')->where('news_number', $news_number)->update([
            'title'       => $request->title,
            'news_typeid' => $request->news_type,
            'dateupload'  => $request->date,
            'description' => $request->description,
            'date'        => now(),
        ]);

        return redirect()->route('news.index')->with('success', 'อัปเดตข่าวสารสำเร็จ');
    }

    /**
     * Remove the specified news item and all associated files from storage.
     */
    public function destroy($news_number)
    {
        DB::beginTransaction();

        try {
            $news_to_delete = DB::table('news')->where('news_number', $news_number)->first();

            if (! $news_to_delete) {
                return redirect()->route('news.index')->with('error', 'ไม่พบข่าวที่ต้องการลบ');
            }

            // ลบภาพหน้าปก
            if (! empty($news_to_delete->path) && ! empty($news_to_delete->picture_name)) {
                $cover_image_path = public_path($news_to_delete->path . '/' . $news_to_delete->picture_name);
                if (File::exists($cover_image_path)) {
                    File::delete($cover_image_path);
                }
            }

            // ลบภาพประกอบ
            $gallery_images = DB::table('picture')->where('news_number', $news_number)->get();
            foreach ($gallery_images as $image) {
                if (! empty($image->path) && ! empty($image->picture_name)) {
                    $gallery_image_path = public_path($image->path . '/' . $image->picture_name);
                    if (File::exists($gallery_image_path)) {
                        File::delete($gallery_image_path);
                    }
                }
            }

            DB::table('picture')->where('news_number', $news_number)->delete();
            DB::table('news')->where('news_number', $news_number)->delete();

            DB::commit();

            return redirect()->route('news.index')->with('success', 'ลบข่าวสารสำเร็จ');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('ลบข่าวผิดพลาด: ' . $e->getMessage());
            return redirect()->route('news.index')->with('error', 'เกิดข้อผิดพลาดในการลบข่าวสาร');
        }
    }
}
