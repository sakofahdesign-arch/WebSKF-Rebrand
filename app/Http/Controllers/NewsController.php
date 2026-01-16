<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class NewsController extends Controller
{
    public function index()
    {
        $data = DB::table('news')->join('news_type', 'news.news_typeid', '=', 'news_type.news_typeid')->select('title', 'news_typename', 'dateupload', 'news_number', 'news_number')->orderByDesc('dateupload')->paginate(15);
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
            'news_type'       => 'required|exists:news_type,news_typeid',
            'date'            => 'required|date',
            'description'     => 'required|string',
            'coverImage'      => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
            'uploadedFiles.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ], [
            'title.required'        => 'กรุณาระบุหัวข้อข่าว',
            'title.max'             => 'หัวข้อข่าวต้องไม่เกิน 255 ตัวอักษร',
            'news_type.required'    => 'กรุณาเลือกประเภทข่าว',
            'date.required'         => 'กรุณาระบุวันที่เผยแพร่',
            'description.required'  => 'กรุณาระบุรายละเอียดข่าว',
            'coverImage.required'   => 'กรุณาอัปโหลดรูปภาพหน้าปก',
            'coverImage.image'      => 'ไฟล์หน้าปกต้องเป็นรูปภาพ',
            'coverImage.max'        => 'รูปภาพหน้าปกต้องมีขนาดไม่เกิน 5MB',
            'uploadedFiles.*.image' => 'ไฟล์แนบแต่ละไฟล์ต้องเป็นรูปภาพ',
        ]);

        DB::beginTransaction();
        $uploadedFilePaths = [];

        try {
            do {
                $news_number = mt_rand(10000, 99999);
            } while (DB::table('news')->where('news_number', $news_number)->exists());

            $coverImage = $request->file('coverImage');
            $coverPath = 'uploads/covers';
            $hashedCoverImage = $news_number . '_' . date('YmdHis') . '.' . $coverImage->getClientOriginalExtension();

            $coverImage->move(public_path($coverPath), $hashedCoverImage);
            $uploadedFilePaths[] = public_path($coverPath . '/' . $hashedCoverImage);

            DB::table('news')->insert([
                'news_number'  => $news_number,
                'title'        => $request->input('title'),
                'news_typeid'  => $request->input('news_type'),
                'dateupload'   => $request->input('date'),
                'description'  => $request->input('description'),
                'picture_name' => $hashedCoverImage,
                'date'         => now(),
            ]);

            if ($request->hasFile('uploadedFiles')) {
                $galleryPath = 'uploads/galleries';

                foreach ($request->file('uploadedFiles') as $index => $file) {
                    $order = sprintf('%02d', $index + 1);
                    $hashedFileName = $news_number . '_' . date('YmdHis') . $order . '.' . $file->getClientOriginalExtension();

                    $file->move(public_path($galleryPath), $hashedFileName);


                    $uploadedFilePaths[] = public_path($galleryPath . '/' . $hashedFileName);

                    DB::table('picture')->insert([
                        'news_number'  => $news_number,
                        'picture_name' => $hashedFileName,
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('news.index')->with('success', 'อัพโหลดข่าวสารสำเร็จ');
        } catch (\Exception $e) {
            DB::rollBack();
            foreach ($uploadedFilePaths as $path) {
                if (File::exists($path)) {
                    File::delete($path);
                }
            }

            Log::error('News Upload Error: ' . $e->getMessage());

            return back()->withInput()->with('error', 'เกิดข้อผิดพลาด: ' . $e->getMessage());
        }
    }

    public function edit($news_number)
    {
        $news = DB::table('news')->where('news_number', $news_number)->first();
        if (! $news) {
            return redirect()->route('news.index')->with('error', 'ไม่พบข่าวที่ต้องการแก้ไข');
        }
        $pictures = DB::table('picture')->where('news_number', $news_number)->get();
        return view('office.news.edit', [
            'news'     => $news,
            'pictures' => $pictures,
        ]);
    }

    public function update(Request $request, $news_number)
    {
        // 1. Validation
        $request->validate([
            'title'           => 'required|string|max:255',
            'news_type'       => 'required',
            'date'            => 'required|date',
            'description'     => 'required|string',
            'coverImage'      => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'uploadedFiles.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        DB::beginTransaction();

        $newFilesPath = []; // เก็บ path ไฟล์ใหม่ (ลบทิ้งถ้า Error)
        $oldFilesToDelete = []; // เก็บ path ไฟล์เก่า (ลบทิ้งถ้า Success)

        try {
            // 2. ตรวจสอบว่ามีข่าวนี้จริงไหม
            $existing_news = DB::table('news')->where('news_number', $news_number)->first();
            if (! $existing_news) {
                return redirect()->back()->with('error', 'ไม่พบข่าวที่ต้องการอัปเดต');
            }

            // 3. เตรียมข้อมูลสำหรับอัปเดต (ข้อความ)
            $updateData = [
                'title'       => $request->input('title'),
                'news_typeid' => $request->input('news_type'),
                'dateupload'  => $request->input('date'),
                'description' => $request->input('description'),
            ];

            // 4. จัดการรูปภาพหน้าปก (Cover Image)
            if ($request->hasFile('coverImage')) {
                $coverFile = $request->file('coverImage');
                $coverPath = 'uploads/covers';
                $hashedCoverImage = $news_number . '_' . date('YmdHis') . '_cover.' . $coverFile->getClientOriginalExtension();

                // อัปโหลดไฟล์ใหม่
                $coverFile->move(public_path($coverPath), $hashedCoverImage);
                $newFilesPath[] = public_path($coverPath . '/' . $hashedCoverImage);

                // เพิ่มชื่อไฟล์ลงใน Array ที่จะอัปเดต
                $updateData['picture_name'] = $hashedCoverImage;

                // เก็บ Path รูปเก่าไว้รอการลบ (ยังไม่ลบตอนนี้ รอ Commit ก่อน)
                if ($existing_news->picture_name) {
                    $oldFilesToDelete[] = public_path($coverPath . '/' . $existing_news->picture_name);
                }
            }

            // อัปเดตตาราง news
            DB::table('news')->where('news_number', $news_number)->update($updateData);

            // 5. จัดการรูปภาพประกอบ (Gallery) - แบบแทนที่ของเดิม (Replace All)
            if ($request->hasFile('uploadedFiles')) {
                $galleryPath = 'uploads/galleries';

                // ดึงรูปประกอบเก่ามาเก็บไว้รอการลบ
                $oldPictures = DB::table('picture')->where('news_number', $news_number)->get();
                foreach ($oldPictures as $pic) {
                    $oldFilesToDelete[] = public_path($galleryPath . '/' . $pic->picture_name);
                }

                // ลบข้อมูลใน Database (ตาราง picture) ก่อน
                DB::table('picture')->where('news_number', $news_number)->delete();

                // วนลูปอัปโหลดรูปใหม่
                foreach ($request->file('uploadedFiles') as $index => $file) {
                    $order = sprintf('%02d', $index + 1);
                    $hashedFileName = $news_number . '_' . date('YmdHis') . '_' . $order . '.' . $file->getClientOriginalExtension();

                    // อัปโหลดไฟล์
                    $file->move(public_path($galleryPath), $hashedFileName);
                    $newFilesPath[] = public_path($galleryPath . '/' . $hashedFileName);

                    // Insert ลง Database
                    DB::table('picture')->insert([
                        'news_number'  => $news_number,
                        'picture_name' => $hashedFileName,
                    ]);
                }
            }

            // 6. ถ้าทำงานถึงตรงนี้แสดงว่าไม่มี Error -> ยืนยัน Transaction
            DB::commit();

            // 7. ลบไฟล์เก่าจริงๆ (ทำหลังจากมั่นใจว่าข้อมูลใหม่เข้า DB แล้ว)
            foreach ($oldFilesToDelete as $path) {
                if (File::exists($path)) {
                    File::delete($path);
                }
            }

            return redirect()->route('news.index')->with('success', 'อัปเดตข่าวสารสำเร็จ');
        } catch (\Exception $e) {
            // 8. กรณีเกิด Error -> ยกเลิก Transaction
            DB::rollBack();

            // ลบไฟล์ใหม่ที่เพิ่งอัปโหลดไปทิ้ง (เพราะการบันทึกล้มเหลว)
            foreach ($newFilesPath as $path) {
                if (File::exists($path)) {
                    File::delete($path);
                }
            }

            Log::error('News Update Error: ' . $e->getMessage());

            return back()->with('error', 'เกิดข้อผิดพลาด: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($news_number)
    {
        DB::beginTransaction();

        try {
            // 1. ค้นหาข่าวหลัก
            $news_to_delete = DB::table('news')->where('news_number', $news_number)->first();

            if (! $news_to_delete) {
                return redirect()->route('news.index')->with('error', 'ไม่พบข่าวที่ต้องการลบ');
            }

            // 2. ลบไฟล์ภาพหน้าปกจาก uploads/covers
            if (! empty($news_to_delete->picture_name)) {
                $cover_image_path = public_path('uploads/covers/' . $news_to_delete->picture_name);
                if (File::exists($cover_image_path)) {
                    File::delete($cover_image_path);
                }
            }

            // 3. ค้นหาและลบภาพประกอบจาก uploads/galleries
            $gallery_images = DB::table('picture')->where('news_number', $news_number)->get();

            foreach ($gallery_images as $image) {
                if (! empty($image->picture_name)) {
                    $gallery_image_path = public_path('uploads/galleries/' . $image->picture_name);
                    if (File::exists($gallery_image_path)) {
                        File::delete($gallery_image_path);
                    }
                }
            }

            // 4. ลบข้อมูลในฐานข้อมูล
            DB::table('picture')->where('news_number', $news_number)->delete();
            DB::table('news')->where('news_number', $news_number)->delete();

            DB::commit();

            return redirect()->back()->with('success', 'ลบข่าวสารพร้อมรูปภาพเรียบร้อยแล้ว');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('เกิดข้อผิดพลาดในการลบข่าว: ' . $e->getMessage());

            return redirect()->back()->with('error', 'เกิดข้อผิดพลาดในการลบข่าวสาร');
        }
    }
}
