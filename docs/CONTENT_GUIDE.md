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

## สรุปจุดที่แก้ล่าสุด

### ตัวเลขสถานะทางการเงินหน้าแรก

แก้ตัวเลขทั้งหมดในไฟล์:

```text
config/site-content.php
```

ค้นหาคำว่า:

```php
'financial_status' => [
```

ตัวอย่างค่าที่เปลี่ยนได้:

```php
'meta' => [
    'data_date_label' => 'ข้อมูล ณ วันที่ 08 สิงหาคม 2569',
    'fiscal_year_label' => 'ประจำปีบัญชี 2567',
],

'financial' => [
    'total_members' => ['value' => '14,075', 'odometer' => 14075],
    'associate_members' => ['value' => '1,124', 'odometer' => 1124],
    'shares' => ['value' => '28,736,215', 'odometer' => 28736215, 'unit' => 'หุ้น'],
    'share_amount' => ['value' => '287,362,150', 'odometer' => 287362150, 'unit' => 'บาท'],
    'assets' => ['value' => '0', 'odometer' => 0, 'unit' => 'ล้าน', 'trend' => '+6.2% จากปีก่อนหน้า'],
    'deposits' => ['value' => '7,762', 'odometer' => 7762, 'unit' => 'ล้าน', 'trend' => '+4.8% จากปีก่อนหน้า'],
],
```

หลักการคือ `value` คือข้อความที่แสดงบนเว็บ ส่วน `odometer` คือตัวเลขสำหรับเอฟเฟกต์วิ่งเลข ให้ใส่เป็นตัวเลขล้วน ไม่ต้องมี comma.

ไฟล์หน้าแสดงผลคือ:

```text
resources/views/components/welcomes/financial-status.blade.php
```

ปกติไม่ต้องแก้ไฟล์นี้แล้ว นอกจากต้องการเปลี่ยนหน้าตา layout หรือไอคอน.

### แบนเนอร์โปรโมชั่นหน้าแรก

แก้รายการรูปที่ไฟล์:

```text
config/site-content.php
```

ค้นหาคำว่า:

```php
'promotions' => [
```

รูปที่แสดงจะใช้เฉพาะรายการใน `promotions` เท่านั้น ไม่ดึงรูปข่าวอื่นมาเพิ่มแล้ว.

ไฟล์รูปวางไว้ที่:

```text
public/content/banners
```

ไฟล์หน้าแสดงผลคือ:

```text
resources/views/components/welcomes/promotion-carousel.blade.php
```

### แผนที่สาขาและแผนที่ขายทรัพย์

ข้อมูลสาขาแก้ที่:

```text
config/site-content.php
```

คีย์ที่เกี่ยวข้อง:

```php
'branches' => [
'business_units' => [
'branch_order' => [
```

รูปสาขาวางที่:

```text
public/content/branches
```

โลโก้ marker วางที่:

```text
public/content/logos
```

ไฟล์ React ของแผนที่สาขาคือ:

```text
components/ui/branch-network-map.tsx
```

ถ้าแก้ไฟล์ใน `components` หรือ `resources/js` ต้องรัน build และคัดลอก `public/build` ขึ้นเซิร์ฟเวอร์ด้วย.

### ระบบจัดการทรัพย์สินขาย

ไฟล์ควบคุมหลัก:

```text
app/Http/Controllers/AssetController.php
resources/views/office/admin/assets/edit.blade.php
```

ข้อมูลอยู่ในฐานข้อมูลตาราง:

```text
asset
asset_picture
```

รูปที่อัปโหลดจากหลังบ้านจะอยู่ที่:

```text
public/assets
```

ถ้ารูปไม่ขึ้นบน IIS ให้เช็กว่าไฟล์อยู่จริงใน `D:\webdata\skforth\public\assets` และ root `web.config` route ไฟล์ static ไปที่ `public`.

### web.config บน IIS

ไฟล์ที่ต้องอยู่หน้าแรกของโปรเจกต์:

```text
D:\webdata\skforth\web.config
```

ไม่ต้องมีไฟล์นี้ใน:

```text
D:\webdata\skforth\public\web.config
```

หน้าที่ของ root `web.config` คือส่ง request ไปที่ Laravel ในโฟลเดอร์ `public` และเปิดทางให้ไฟล์ static เช่น `assets`, `build`, `content`, `images`, `uploads` ถูกเรียกได้.

## เวลาคัดลอกขึ้นเซิร์ฟเวอร์รอบนี้

คัดลอกไฟล์เหล่านี้ไปทับบนเซิร์ฟเวอร์:

```text
config/site-content.php
resources/views/components/welcomes/financial-status.blade.php
resources/views/components/welcomes/promotion-carousel.blade.php
components/ui/branch-network-map.tsx
app/Http/Controllers/AssetController.php
resources/views/office/admin/assets/edit.blade.php
web.config
```

และคัดลอกทั้งโฟลเดอร์นี้ไปทับ:

```text
public/build
```

หลังคัดลอกเสร็จ รันที่ `D:\webdata\skforth`:

```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
```

ถ้าเว็บยังใช้ไฟล์ CSS/JS เก่า ให้ล้าง cache browser หรือกด hard refresh.
