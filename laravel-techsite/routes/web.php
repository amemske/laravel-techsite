<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Home\AboutController;
use App\Http\Controllers\Home\FooterController;
use App\Http\Controllers\Home\HomeSliderController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('frontend.index');
})->name('home');



Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::controller(AdminController::class)->group(function() {
    Route::get('/admin/logout', 'destroy')->name('admin.logout');
    Route::get('/admin/profile', 'profile')->name('admin.profile');
    Route::get('/admin/edit_profile', 'editProfile')->name('admin.edit_profile');
    Route::post('/admin/store_profile', 'storeProfile')->name('admin.store_profile');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::controller(HomeSliderController::class)->group(function() {
    Route::get('/home/slide', 'createSlider')->name('home.slide');
    Route::post('/update/slide', 'updateSlider')->name('update.slider');
});

Route::controller(AboutController::class)->group(function() {
    Route::get('/about/page', 'createAboutPage')->name('about.page');
    Route::post('/update/about', 'updateAboutPage')->name('update.about');
    Route::get('/about', 'mainAboutPage')->name('main.about.page');
});

Route::controller(FooterController::class)->group(function() {
    Route::get('/footer/setup', 'footerSetup')->name('footer.setup');
});

require __DIR__.'/auth.php';
