<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PlantController;
use App\Http\Controllers\PlantCategoryController;

Route::get('/', function () {
    return view('home');
})->name('home');

 Route::get('/logout', [UserController::class, 'logout'])->name('logout');

Route::middleware('isGuest')->group(function () {
    Route::get('/login', function () {
    return view('login');
})->name('login');
Route::post('/login', [UserController::class, 'login'])->name('login.send_data');
Route::get('/sign-up', function () {
    return view('signup');
})->name('signup');
Route::post('/signup', [UserController::class, 'register'])->name('signup.send_data');
});

Route::middleware('isLoggedIn')->group(function () {
  Route::get('/gallery', function () {
    return view('gallery');
})->name('gallery');
   });


Route::middleware('isAdmin')->prefix('/admin')->name('admin.')->group(function() {
    Route::get('/dashboard', function() {
        return view('admin.dashboard');
    })->name('dashboard');

Route::prefix('plants')->name('plants.')->group(function() {
    Route::get('/', [PlantController::class, 'index'])->name('index');
    Route::get('/create', [PlantController::class, 'create'])->name('create');

    Route::post('/store', [PlantController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [PlantController::class, 'edit'])->name('edit');
    Route::post('/update/{id}', [PlantController::class, 'update'])->name('update');
    Route::delete('/delete/{id}', [PlantController::class, 'destroy'])->name('delete');
    Route::get('/show/{id}', [PlantController::class, 'show'])->name('show');
    Route::get('/export', [PlantController::class, 'exportExcel'])->name('export');


    // Add more plant-related routes here
});

Route::prefix('category')->name('category.')->group(function() {
    Route::get('/', [PlantCategoryController::class, 'index'])->name('index');
    Route::get('/create', function() {
        return view('admin.category.create');
    })->name('create');
    Route::post('/store', [PlantCategoryController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [PlantCategoryController::class, 'edit'])->name('edit');
    Route::put('/update/{id}', [PlantCategoryController::class, 'update'])->name('update');
    Route::delete('/delete/{id}', [PlantCategoryController::class, 'destroy'])->name('delete');
    Route::get('/export', [PlantCategoryController::class, 'exportExcel'])->name('export');
});

});
