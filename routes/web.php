<?php

use App\Http\Controllers\AssetController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CreditController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\OfficerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PerformanceController;
use App\Http\Controllers\PublishController;
use Illuminate\Support\Facades\Route;

//  Main page
Route::get('/', [HomeController::class, 'index']);
Route::get('/history', [HomeController::class, 'history']);
Route::get('/vision', [HomeController::class, 'vision']);
Route::get('/manager', [HomeController::class, 'manager']);
Route::get('/office', [HomeController::class, 'office']);
Route::get('/mobile', [HomeController::class, 'mobile']);
Route::get('/structure', [HomeController::class, 'structure']);
Route::get('/register', [HomeController::class, 'register']);
Route::get('/deposit', [HomeController::class, 'deposit']);
Route::get('/credit_service', [HomeController::class, 'credit_service']);
Route::get('/marry', [HomeController::class, 'marry']);
Route::get('/maternity', [HomeController::class, 'maternity']);
Route::get('/oldage', [HomeController::class, 'oldage']);
Route::get('/medical', [HomeController::class, 'medical']);
Route::get('/dead', [HomeController::class, 'dead']);
Route::get('/activity', [HomeController::class, 'activity']);
Route::get('/news/{id}', [HomeController::class, 'news'])->name('news.show');
Route::get('/calender', [HomeController::class, 'calender']);
Route::get('/homeList', [HomeController::class, 'homeList']);
Route::get('/vacantList', [HomeController::class, 'vacantList']);
Route::get('/condoList', [HomeController::class, 'condoList']);
Route::get('/home/{id}', [HomeController::class, 'home']);
Route::get('/vacant/{id}', [HomeController::class, 'vacant']);
Route::get('/condo/{id}', [HomeController::class, 'condo']);
Route::get('/document', [HomeController::class, 'document']);
Route::get('/businessreport', [HomeController::class, 'businessreport']);
Route::get('/withus', [HomeController::class, 'withus']);

// Login
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'store'])->name('store');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['check.session'])->group(function () {
    //Officer
    Route::get('/member', [OfficerController::class, 'member'])->name('member');
    Route::get('/searchMember', [OfficerController::class, 'searchMember'])->name('searchMember');
    Route::get('/data_member', [OfficerController::class, 'data_member'])->name('data_member');
    Route::post('/account_details', [OfficerController::class, 'account_details']);
    Route::post('/loan_details', [OfficerController::class, 'loan_details']);

    Route::get('/rules', [OrderController::class, 'rules'])->name('rules');
    Route::get('/order', [OrderController::class, 'order'])->name('order');
    Route::get('/form', [OrderController::class, 'form'])->name('form');
    Route::get('/publish', [OrderController::class, 'publish'])->name('publish');

    Route::get('/searchcredit', [CreditController::class, 'searchcredit'])->name('searchcredit');
    Route::get('/uploadcredit', [CreditController::class, 'uploadcredit'])->name('uploadcredit');
    Route::post('/postcredit', [CreditController::class, 'postcredit'])->name('postcredit');

// Perfomance
    Route::get('/performance', [PerformanceController::class, 'index'])->name('performance.index');
    Route::get('/add_performance', [PerformanceController::class, 'add_performance'])->name('performance.add');
    Route::post('/uploadPerformance', [PerformanceController::class, 'postPerformance'])->name('performance.upload');

// News
    Route::resource('news', NewsController::class)->names('news');

// Login history
    Route::get('/login_history', [AuthController::class, 'login_history'])->name('login.history');
// Asset
    Route::resource('manage-assets', AssetController::class)->names('asset');
    Route::resource('announcements', PublishController::class)->names('announcements');
});
