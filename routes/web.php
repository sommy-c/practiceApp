<?php
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\ProductController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
});
Route::get('/dashboard', [AuthenticationController::class, 'showDashboard'])->name('dashboard');
Route::get('/login', [AuthenticationController::class, 'showLogin'])->name('login');
Route::get('/signup', [AuthenticationController::class, 'showSignUp'])->name('signup');


Route::Post('/signup', [AuthenticationController::class, 'register'])->name('signup-submit');
Route::Post('/login', [AuthenticationController::class,'login'])->name('login_submit');

Route::Post('logout', [AuthenticationController::class,'logout'])->name('logout');
Route::get('/upload', [ProductController::class, 'showUpload'])->name('upload');
Route::get('/product/{id}', [ProductController::class, 'showProduct'])->name('product');
Route::get('/edit/{id}', [ProductController::class, 'showEdit'])->name('edit')->middleware('auth');

Route::Post('/upload', [ProductController::class, 'upload'])->name('upload.product')->middleware('auth');
Route::Post('uploadProfile',[AuthenticationController::class, 'uploadImage'])->name('upload.profile')->middleware('auth');
Route::Put('/edit/{id}', [ProductController::class, 'updateProduct'])->name('update.product')->middleware('auth');
Route::Delete('/product/{id}', [ProductController::class, 'deleteProduct'])->name('delete.product')->middleware('auth');
Route::get('/search', [ProductController::class, 'search'])->name('product.search');


