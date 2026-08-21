# คู่มือแก้รูปและข้อมูลหน้าเว็บ

ไฟล์ที่แก้บ่อยถูกรวมไว้ที่ `config/site-content.php` แล้ว ส่วนไฟล์รูป/PDF ที่เจ้าของเว็บเปลี่ยนเองให้วางไว้ใน `public/content`.

## โครงไฟล์ที่ใช้แก้คอนเทนต์

```text
public/content/
  hero/       รูป Hero หน้าแรกและโลโก้ Hero
  banners/    รูปโปรโมชัน/แบนเนอร์หน้าแรก
  ebooks/     รูปปก eBook/รายงานออนไลน์
  reports/    PDF รายงานกิจการ
  forms/      PDF เอกสารสำหรับสมาชิก
  branches/   รูปสาขาและสถานที่
  welfare/    รูปหน้าสวัสดิการ
  logos/      โลโก้หน่วยธุรกิจ/โลโก้ marker บนแผนที่
```

## จุดแก้หลัก

### Hero หน้าแรก

ไฟล์รูปอยู่ที่ `public/content/hero`.

แก้รายการที่:

```php
config/site-content.php
```

ส่วนที่ใช้:

```php
'hero' => [
    'logo' => 'content/hero/sakofah-hero-logo.png',
    'slides' => [
        ['src' => 'content/hero/krabi.jpg', 'title' => 'สำนักงานใหญ่'],
    ],
],
```

ถ้าจะเปลี่ยนรูป Hero ให้แทนไฟล์ใน `public/content/hero` หรือเพิ่มไฟล์ใหม่แล้วแก้ค่า `src`.

### Banner / โปรโมชันหน้าแรก

ไฟล์รูปอยู่ที่ `public/content/banners`.

แก้ที่ key:

```php
'promotions' => [
    [
        'slide_image' => 'content/banners/69-01-36.jpg',
        'modal_type' => 'image',
        'modal_content' => 'content/banners/69-01-31.jpg',
    ],
],
```

ถ้า banner กดแล้วไม่ต้องเปิด popup ให้ใส่:

```php
'modal_type' => null,
'modal_content' => null,
```

### eBook / วารสารออนไลน์

รูปปกอยู่ที่ `public/content/ebooks`.

แก้ที่ key:

```php
'ebooks' => [
    [
        'id' => 'annual-report-2568',
        'title' => 'รายงานกิจการ 2568',
        'year' => '2568',
        'href' => 'https://online.anyflip.com/haqcj/kmre/',
        'downloadUrl' => 'https://online.anyflip.com/haqcj/kmre/mobile/index.html',
        'cover' => 'content/ebooks/annual-report-2568-kmre.jpg',
    ],
],
```

เพิ่ม eBook ใหม่โดยวางปกใน `public/content/ebooks` แล้ว copy block เดิมมาเพิ่ม 1 ชุด เปลี่ยน `id`, `title`, `year`, `href`, `downloadUrl`, และ `cover`.

### รายงานกิจการ PDF

PDF อยู่ที่ `public/content/reports`.

แก้ที่:

```php
'downloads' => [
    'reports' => [
        ['year' => '2568', 'name' => 'รายงานกิจการ 2568', 'path' => 'content/reports/report-2568.pdf'],
    ],
],
```

### เอกสารสำหรับสมาชิก

PDF อยู่ที่ `public/content/forms`.

แก้ที่:

```php
'downloads' => [
    'forms' => [
        ['name' => 'ใบคำขอสมัครสมาชิก', 'path' => 'content/forms/member-form.pdf'],
    ],
],
```

### สาขาและแผนที่

รูปสาขาอยู่ที่ `public/content/branches`.

โลโก้ marker หรือโลโก้หน่วยธุรกิจอยู่ที่ `public/content/logos`.

แก้ที่ key:

```php
'branches' => [
    [
        'id' => 'krabi',
        'name' => 'สาขากระบี่',
        'address' => '...',
        'phone' => '075-652-525',
        'image' => 'content/branches/krabi.jpg',
        'latitude' => 8.063564,
        'longitude' => 98.908573,
    ],
],
```

ลำดับที่แสดงในเมนูแผนที่แก้ที่:

```php
'branch_order' => [
    'khlong_yang',
    'krabi',
],
```

## ส่วนที่ยังแก้ผ่านระบบหลังบ้าน

ส่วนนี้ยังไม่ต้องแก้ไฟล์เอง:

- ข่าวและรูปข่าว: ระบบหลังบ้าน บันทึกไฟล์ที่ `public/uploads/covers` และ `public/uploads/galleries`
- ทรัพย์สินขาย: ระบบหลังบ้าน บันทึกไฟล์ที่ `public/assets`
- ประกาศ/เอกสารเจ้าหน้าที่บางส่วน: ระบบหลังบ้าน บันทึกที่ `public/file/*`

## หลังแก้ config บนเซิร์ฟเวอร์

ถ้าเซิร์ฟเวอร์เปิด cache config ไว้ ให้รัน:

```bash
php artisan config:clear
php artisan cache:clear
```

