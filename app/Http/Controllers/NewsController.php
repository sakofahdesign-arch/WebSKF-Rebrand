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
            'picture_name' => $hashedCoverImage,
        ]);

        if ($request->hasFile('uploadedFiles')) {
            $galleryPath = 'uploads/galleries';

            foreach ($request->file('uploadedFiles') as $index => $file) {
                $order          = sprintf('%02d', $index + 1);
                $hashedFileName = $news_number . '_' . date('Ymd') . $order . '.' . $file->getClientOriginalExtension();
                $file->move(public_path($galleryPath), $hashedFileName);

                DB::table('picture')->insert([
                    'news_number'  => $news_number,
                    'picture_name' => $hashedFileName,
                ]);
            }
        }

        return redirect()->route('news.index')->with('success', 'อัพโหลดข่าวสารสำเร็จ');
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
        $request->validate([
            'title'           => 'required|string|max:255',
            'news_type'       => 'required',
            'date'            => 'required|date',
            'description'     => 'required|string',
            'coverImage'      => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'uploadedFiles.*' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        $existing_news = DB::table('news')->where('news_number', $news_number)->first();
        if (! $existing_news) {
            return redirect()->back()->with('error', 'ไม่พบข่าวที่ต้องการอัปเดต');
        }

        $coverImagePath = $existing_news->path . '/' . $existing_news->picture_name;

        if ($request->hasFile('coverImage')) {
            if (File::exists(public_path($coverImagePath))) {
                File::delete(public_path($coverImagePath));
            }

            $coverFile        = $request->file('coverImage');
            $coverPath        = 'uploads/covers';
            $hashedCoverImage = $news_number . '_' . date('YmdHis') . '.' . $coverFile->getClientOriginalExtension();
            $coverFile->move(public_path($coverPath), $hashedCoverImage);

            DB::table('news')->where('news_number', $news_number)->update([
                'picture_name' => $hashedCoverImage,
            ]);
        }
        if ($request->hasFile('uploadedFiles')) {
            $oldPictures = DB::table('picture')->where('news_number', $news_number)->get();
            foreach ($oldPictures as $pic) {
                if (File::exists(public_path('uploads/galleries/' . $pic->picture_name))) {
                    File::delete(public_path('uploads/galleries/' . $pic->picture_name));
                }
            }
            DB::table('picture')->where('news_number', $news_number)->delete();
            $galleryPath = 'uploads/galleries';
            foreach ($request->file('uploadedFiles') as $index => $file) {
                $order          = sprintf('%02d', $index + 1);
                $hashedFileName = $news_number . '_' . date('Ymd') . $order . '.' . $file->getClientOriginalExtension();
                $file->move(public_path($galleryPath), $hashedFileName);
                DB::table('picture')->insert([
                    'news_number'  => $news_number,
                    'picture_name' => $hashedFileName,
                ]);
            }
        }

        DB::table('news')->where('news_number', $news_number)->update([
            'title'       => $request->title,
            'news_typeid' => $request->news_type,
            'dateupload'  => $request->date,
            'description' => $request->description,
            'date'        => now(),
        ]);

        return redirect()->route('news.index')->with('success', 'อัปเดตข่าวสารสำเร็จ');
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
