<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\HomeController;
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
    $brands = DB::table('brands')->get();
    return view('home',compact('brands'));
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


//Admin All Route
Route::get('/home/slider', [HomeController::class,'HomeSlider'])->name('home.slider');
Route::get('/add/slider', [HomeController::class,'AddSlider'])->name('add.slider');
Route::post('/store/slider', [HomeController::class,'StoreSlider'])->name('store.slider');
Route::get('/slider/delete/{id}', [HomeController::class,'DeleteSlider'])->name('delete.slider');
Route::get('/slider/edit/{id}', [HomeController::class,'EditlSider'])->name('edit.slider');;
Route::post('/slider/update/{id}', [HomeController::class,'UpdateSlider']);



Route::middleware(['auth:sanctum', config('jetstream.auth_session'),'verified'])->group(function () {
    Route::get('/dashboard', function () {
       // $users = User::all();
        //$users = DB::table('users')->get();

        return view('admin.index');
    })->name('dashboard');
});
Route::get('/user/logout', [BrandController::class,'Logout'])->name('user.logout');

