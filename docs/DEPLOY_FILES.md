# คู่มือจัดไฟล์ขึ้นเซิร์ฟเวอร์

โปรเจกต์นี้เป็น Laravel + Vite/React บางส่วน หน้าเว็บสาธารณะใช้ไฟล์ใน `public` และ build asset จาก Vite.

## โฟลเดอร์สำคัญที่ต้องมีบนเซิร์ฟเวอร์

```text
app/
bootstrap/
config/
database/
public/
resources/
routes/
storage/
vendor/
```

ไฟล์สำคัญ:

```text
.env
artisan
composer.json
composer.lock
package.json
package-lock.json
vite.config.js
```

## โฟลเดอร์คอนเทนต์ที่เจ้าของเว็บแก้เอง

ต้องอัปโหลดไปด้วยเสมอ:

```text
public/content/
public/uploads/
public/assets/
public/file/
```

`public/content` คือโครงใหม่สำหรับ Hero, banner, eBook, PDF รายงาน, PDF ฟอร์ม, รูปสาขา, โลโก้ และรูปสวัสดิการ

## โฟลเดอร์ที่ไม่จำเป็นต้องอัป ถ้าติดตั้งบนเซิร์ฟเวอร์เอง

```text
node_modules/
vendor/
```

ถ้าเซิร์ฟเวอร์รัน `composer install` ได้ ไม่ต้องอัป `vendor`.

ถ้าเซิร์ฟเวอร์รัน `npm install` และ `npm run build` ได้ ไม่ต้องอัป `node_modules`.

## คำสั่งติดตั้งบนเซิร์ฟเวอร์

```bash
composer install --no-dev --optimize-autoloader
npm install
npm run build
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
php artisan storage:link
```

ถ้าเซิร์ฟเวอร์ไม่มี Node.js ให้ build จากเครื่องตัวเองก่อน แล้วอัปโหลดไฟล์ build ใน `public/build`.

## ค่า .env ที่ต้องตรวจ

```env
APP_NAME=
APP_ENV=production
APP_KEY=
APP_DEBUG=false
APP_URL=https://your-domain.com

DB_CONNECTION=mysql
DB_HOST=
DB_PORT=3306
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```

ห้ามใช้ `.env` จากเครื่อง dev แบบไม่ตรวจ เพราะอาจมี `APP_DEBUG=true` หรือฐานข้อมูลผิด.

## Permission ที่ Laravel ต้องเขียนได้

ให้เซิร์ฟเวอร์เขียนได้ใน:

```text
storage/
bootstrap/cache/
public/uploads/
public/assets/
public/file/
public/content/
```

ถ้า upload ข่าว/เอกสารไม่ได้ ให้เช็ก permission ของโฟลเดอร์เหล่านี้ก่อน.

## Document Root

Document root ของเว็บควรชี้ไปที่:

```text
public/
```

ไม่ควรชี้ไปที่ root โปรเจกต์ เพราะจะเปิดเผยไฟล์ config, `.env`, และ source code.

## หลังแก้รูปหรือ config บน production

ถ้าเปลี่ยนแค่รูปใน `public/content` โดยใช้ชื่อไฟล์เดิม ปกติ refresh หน้าเว็บก็พอ.

ถ้าแก้ `config/site-content.php` ให้รัน:

```bash
php artisan config:clear
php artisan cache:clear
```

