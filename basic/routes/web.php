<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Models\User;
use Illuminate\Support\Facades\DB;

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::controller(ImageController::class)->group(function(){
    Route::get('image-upload', 'index');
    Route::post('image-upload', 'store')->name('image.store');
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    echo " This Home Page";
});

Route::get('about', function () {
    return view('about');
});


Route::get('/contact', [ContactController::class,'index']);

//Category Controller

Route::get('/category/all', [CategoryController::class,'AllCat'])->name('all.category');
Route::post('/category/add', [CategoryController::class,'AddCat'])->name('store.category');

Route::get('/category/edit/{id}', [CategoryController::class,'Edit']);
Route::get('brand/edit/{id}', [CategoryController::class,'Edit']);
Route::post('/category/update/{id}', [CategoryController::class,'Update']);
Route::get('/softdelete/category/{id}', [CategoryController::class,'SoftDelete']);
Route::get('category/restore/{id}', [CategoryController::class,'Restore']);
Route::get('category/deleteperm/{id}', [CategoryController::class,'DeletePerm']);


//Brand Controller
Route::get('/brand/all', [BrandController::class,'Allbrand'])->name('all.brand');
Route::post('/brand/add', [BrandController::class,'AddBrand'])->name('store.brand');
Route::get('/brand/edit/{id}', [BrandController::class,'Edit']);
Route::post('/brand/update/{id}', [BrandController::class,'Update']);
Route::get('/brand/delete/{id}', [BrandController::class,'Delete']);

//Multipic Route
Route::get('/multi/image', [BrandController::class,'multpic'])->name('multi.image');
Route::post('/multi/add', [BrandController::class,'AddImage'])->name('store.image');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'),'verified'])->group(function () {
    Route::get('/dashboard', function () {
       // $users = User::all();
        //$users = DB::table('users')->get();

        return view('admin.index');
    })->name('dashboard');
});
Route::get('/user/logout', [BrandController::class,'Logout'])->name('user.logout');

