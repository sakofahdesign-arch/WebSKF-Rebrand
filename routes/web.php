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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route สำหรับ JavaScript ที่ส่งมาเมื่อผู้ใช้กด 'ยอมรับ'
Route::post('/set-cookie-consent', function (Request $request) {
    if ($request->accepted) {
        session()->put('cookie_accepted', true);
        return response()->json(['status' => 'success', 'message' => 'Cookie consent session set.']);
    }
    return response()->json(['status' => 'error', 'message' => 'Invalid request.'], 400);
});
Route::post('/track-visitor', [HomeController::class, 'track']);
Route::view('/privacy-policy', 'privacy');

//  Main page
Route::get('/', [HomeController::class, 'index'])->name('index');

Route::get('/history', [HomeController::class, 'history'])->name('history');
Route::get('/vision', [HomeController::class, 'vision'])->name('vision');
Route::get('/manager', [HomeController::class, 'manager'])->name('manager');
Route::get('/office', [HomeController::class, 'office'])->name('office');
Route::get('/mobile', [HomeController::class, 'mobile'])->name('mobile');
Route::get('/structure', [HomeController::class, 'structure'])->name('structure');
Route::get('/register', [HomeController::class, 'register'])->name('register');
Route::get('/deposit', [HomeController::class, 'deposit'])->name('deposit');
Route::get('/credit_service', [HomeController::class, 'credit_service'])->name('credit_service');
Route::get('/marry', [HomeController::class, 'marry'])->name('marry');
Route::get('/maternity', [HomeController::class, 'maternity'])->name('maternity');
Route::get('/oldage', [HomeController::class, 'oldage'])->name('oldage');
Route::get('/medical', [HomeController::class, 'medical'])->name('medical');
Route::get('/dead', [HomeController::class, 'dead'])->name('dead');
Route::get('/activity', [HomeController::class, 'activity'])->name('activity');
Route::get('/article/{id}', [HomeController::class, 'article'])->name('article');
Route::get('/calender', [HomeController::class, 'calender'])->name('calender');
Route::get('/homeList', [HomeController::class, 'homeList'])->name('homeList');
Route::get('/vacantList', [HomeController::class, 'vacantList'])->name('vacantList');
Route::get('/condoList', [HomeController::class, 'condoList'])->name('condoList');
Route::get('/home/{id}', [HomeController::class, 'home'])->name('home');
Route::get('/vacant/{id}', [HomeController::class, 'vacant'])->name('vacant');
Route::get('/condo/{id}', [HomeController::class, 'condo'])->name('condo');
Route::get('/document', [HomeController::class, 'document'])->name('document');
Route::get('/businessreport', [HomeController::class, 'businessreport'])->name('businessreport');
Route::get('/withus', [HomeController::class, 'withus'])->name('withus');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
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

    // Credit
    Route::get('/searchcredit', [CreditController::class, 'searchcredit'])->name('searchcredit');
    Route::get('/uploadcredit', [CreditController::class, 'uploadcredit'])->name('uploadcredit');
    Route::post('/postcredit', [CreditController::class, 'postcredit'])->name('postcredit');
    Route::get('/credit', [CreditController::class, 'index'])->name('credit.index');
    Route::delete('/credit/{id}', [CreditController::class, 'destroy'])->name('credit.delete');

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
