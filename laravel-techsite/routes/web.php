<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Home\AboutController;
use App\Http\Controllers\Home\BlogCategoryController;
use App\Http\Controllers\Home\ContactController;
use App\Http\Controllers\Home\FooterController;
use App\Http\Controllers\Home\HomeSliderController;
use App\Http\Controllers\Home\PortfolioController;
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
    Route::get('/about/multi/image', 'aboutMultiImage')->name('about.multi.image');
    Route::post('/store/multi/image', 'storeMultiImage')->name('store.multi.image');
    Route::get('/all/multi/image', 'allMultiImage')->name('all.multi.image');
    Route::get('/edit/multi/image/{id}', 'editMultiImage')->name('edit.multi.image');
    Route::post('/update/multi/image', 'updateMultiImage')->name('update.multi.image');
    Route::get('/delete/multi/image/{id}', 'deleteMultiImage')->name('delete.multi.image');
});

Route::controller(FooterController::class)->group(function() {
    Route::get('/footer/setup', 'footerSetup')->name('footer.setup');
    Route::post('/update/setup', 'updateFooter')->name('update.footer');
});

Route::controller(ContactController::class)->group(function() {
    Route::get('/contact', 'contact')->name('contact.me');
    Route::post('/store', 'storeMessage')->name('store.message');
});

Route::controller(PortfolioController::class)->group(function() {
    Route::get('/all/portfolio', 'allPortfolio')->name('all.portfolio');
    Route::get('/create/portfolio', 'createPortfolio')->name('create.portfolio');
    Route::post('/store/portfolio', 'storePortfolio')->name('store.portfolio');
    Route::get('/edit/portfolio/{id}', 'editPortfolio')->name('edit.portfolio');
    Route::get('/delete/portfolio/{id}', 'deletePortfolio')->name('delete.portfolio');
        Route::post('/update/portfolio', 'updatePortfolio')->name('update.portfolio');
        //front end routes
    Route::get('/portfolio/details/{id}', 'portfolioDetails')->name('portfolio.details');
});

Route::controller(BlogCategoryController::class)->group(function() {
    Route::get('/all/blog/category', 'allBlogCategory')->name('all.blog.category');
    Route::get('/add/blog/category', 'addBlogCategory')->name('add.blog.category');
    Route::post('/store/blog/category', 'storeBlogCategory')->name('store.blog.category');
    Route::get('/edit/blog/category/{id}', 'editBlogCategory')->name('edit.blog.category');
    Route::post('/update/blog/category/{id}', 'updateBlogCategory')->name('update.blog.category');
    Route::get('/delete/blog/category/{id}', 'deleteBlogCategory')->name('delete.blog.category');
});

require __DIR__.'/auth.php';
