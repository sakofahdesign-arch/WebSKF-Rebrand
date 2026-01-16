<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เกิดข้อผิดพลาด - 403 Forbidden</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.x.x/dist/full.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Sarabun', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50 h-screen flex items-center justify-center">

    <div class="text-center px-4">
        <div class="mb-6">
            <div class="w-24 h-24 bg-red-100 rounded-full flex items-center justify-center mx-auto animate-pulse">
                <i class="fas fa-exclamation-triangle text-5xl text-red-500"></i>
            </div>
        </div>

        <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">ขออภัย! เกิดข้อผิดพลาด</h1>

        <p class="text-lg text-gray-500 mb-8 max-w-md mx-auto">
            ระบบขัดข้องชั่วคราว ทางเราได้บันทึกข้อมูลความผิดพลาดแล้ว และกำลังดำเนินการแก้ไขโดยเร็วที่สุด
        </p>

        <div class="flex flex-col md:flex-row justify-center gap-4">
            <a href="{{ url('/') }}" class="btn bg-emerald-600 hover:bg-emerald-700 text-white border-none px-8">
                <i class="fas fa-home mr-2"></i> กลับหน้าหลัก
            </a>
            <button onclick="location.reload()" class="btn btn-outline text-gray-600 hover:bg-gray-100">
                ลองใหม่อีกครั้ง
            </button>
        </div>

        <p class="mt-12 text-sm text-gray-400">Error Code: 500 | Server Internal Error</p>
    </div>

</body>

</html>
