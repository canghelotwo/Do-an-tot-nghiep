<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Admin\LoginController;
use \App\Http\Controllers\AdminController;
use \App\Http\Controllers\DottiemController;
use \App\Http\Controllers\LichtiemController;
use \App\Http\Controllers\LieutrinhController;
use \App\Http\Controllers\VaccineController;
use \App\Http\Controllers\UserController;
use \App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('admin/users/login', [LoginController::class, 'index'])->name('login');
Route::post('admin/users/login/store', [LoginController::class, 'store']);
// Route::get('admin/users/forgot-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
// Route::post('admin/users/forgot-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post'); 
// Route::get('admin/users/reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
// Route::post('admin/users/reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');
// Route::get('admin/dottiem',  [MainController::class, 'indexdottiem'])-> name('dotiem.all');
Route::middleware(['auth'])->group(function() {
    Route::prefix('admin')->group(function () {
        Route::get('/', [AdminController::class, 'index'])-> name('admin');
        Route::get('main', [AdminController::class, 'index']);
        Route::get('logout', [AdminController::class, 'logout'])->name('logout');
        
       
        Route::get('/dottiem', 'DottiemController@all_dottiem')->name('dottiem.all');
        Route::get('/dottiem/add','DottiemController@add_dottiem')->name('dottiem.add');
        Route::post('/dottiem/save','DottiemController@save_dottiem')->name('dottiem.save');
        Route::get('/dottiem/edit/{id}','DottiemController@edit_dottiem')->name('dottiem.edit');
        Route::post('/dottiem/update/{id}','DottiemController@update_dottiem')->name('dottiem.update');
        Route::get('/dottiem/delete/{id}','DottiemController@delete_dottiem')->name('dottiem.delete');
        //vaccine
        Route::get('/vaccine', 'VaccineController@all_vaccine')->name('vaccine');
        Route::get('/vaccine/add','VaccineController@add_vaccine')->name('vaccine.add');
        Route::post('/vaccine/save','VaccineController@save_vaccine')->name('vaccine.save');
        Route::get('/vaccine/edit/{id}','VaccineController@edit_vaccine')->name('vaccine.edit');
        Route::post('/vaccine/update/{id}','VaccineController@update_vaccine')->name('vaccine.update');
        Route::get('/vaccine/delete/{id}','VaccineController@delete_vaccine')->name('vaccine.delete');
        //account
        Route::get('/account', 'UserController@all_user')->name('user');
        Route::get('/account/add','UserController@add_user')->name('user.add');
        Route::post('/account/save','UserController@save_user')->name('user.save');
        Route::get('/account/edit/{id}','UserController@edit_user')->name('user.edit');
        Route::post('/account/update/{id}','UserController@update_user')->name('user.update');
        Route::get('/account/delete/{id}','UserController@delete_user')->name('user.delete');
        //lich tiem
        Route::get('/lichtiem', 'LichtiemController@all_lichtiem')->name('lichtiem');
        Route::get('/export/{id}', 'LichtiemController@Export')->name('export');
        //lieu trinh
        Route::get('/lieutrinh', 'LieutrinhController@all_lieutrinh')->name('lieutrinh');
        Route::get('/lieutrinh/add','LieutrinhController@add_lieutrinh')->name('lieutrinh.add');
        Route::post('/lieutrinh/save','LieutrinhController@save_lieutrinh')->name('lieutrinh.save');
        Route::get('/lieutrinh/edit/{id}','LieutrinhController@edit_lieutrinh')->name('lieutrinh.edit');
        Route::post('/lieutrinh/update/{id}','LieutrinhController@update_lieutrinh')->name('lieutrinh.update');
        Route::get('/lieutrinh/delete/{id}','LieutrinhController@delete_lieutrinh')->name('lieutrinh.delete');
    });
});

//home
Route::get('/', 'HomeController@index')->name('home');
Route::get('/trangchu', 'HomeController@index');
//đăng ký - đăng nhập
Route::get('/dangnhap', 'HomeController@login')->name('dangnhap');
Route::post('/dangnhap/post', 'HomeController@login_user')->name('login_user');
Route::get('/dangxuat', 'HomeController@logout_user')->name('logout_user');
Route::get('/dangky', 'HomeController@registration');
//cập nhật thông tin cá nhân
Route::get('/profile', 'HomeController@profile')->name('profile');
Route::post('/profile/update/{id}', 'HomeController@update_profile')->name('update.profile');
Route::get('/updatepassword', 'HomeController@updatepassword')->name('updatepassword');
Route::post('/updatepassword/update/{id}', 'HomeController@update_password')->name('update.password');
//đăng ký tiêm chủng
Route::get('/dangkytiemchung', 'HomeController@dangkytiemchung')->name('dangkytiemchung');
Route::get('/timkiemmatre', 'HomeController@timkiemmatre')->name('timkiemmatre');
Route::post('/dangkytiemchungcoma', 'HomeController@dangkytiemchungcoma')->name('dangkytiemchungcoma');
Route::post('/dktc/post', 'HomeController@dktc_post')->name('dktc_post');
Route::post('/dktc/coma/{kid_id}', 'HomeController@dktc_coma')->name('dktc_coma');
Route::post('/dktc/post/{id}', 'HomeController@dktc_post_user')->name('dktc_post_user');
//đăng ký tài khoản
Route::post('/dangky/create','UserController@create_user')->name('create_user');
//danh sách đã đăng ký
Route::get('/dadangky/{id}', 'HomeController@dadangky')->name('dadangky');
//xử lý tiêm của bác sĩ
Route::get('/timkiemtredkt', 'HomeController@timkiemtredkt')->name('bacsitimkiem');
Route::post('/xulytiem', 'HomeController@xulytiem')->name('xulytiem');
Route::post('/xulytiem_post/{id}/{user_id}', 'HomeController@xulytiem_post')->name('xulytiem_post');
Route::get('/xulytiem/cancel/{id}/{user_id}', 'HomeController@xulytiem_cancel')->name('xulytiem_cancel');
//xử lý thông tin sau tiêm của y tá
Route::get('/timkiemtreyta', 'HomeController@timkiemtreyta')->name('ytatimkiem');
Route::post('/xulytt', 'HomeController@xulytt')->name('xulytt');
Route::get('/xulytt/{id}/{user_id}', 'HomeController@xulytt_post')->name('xulytt_post');
//lịch sử tiêm chủng của tài khoản
Route::get('/lichsutiem/{id}', 'HomeController@lichsutiem')->name('lichsutiem');
Route::get('/chitietlst/{kid_id}/{vaccine_id}', 'HomeController@chitietls')->name('chitietls');



