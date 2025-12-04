<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PlantController;
use App\Http\Controllers\PlantCategoryController;
use App\Http\Controllers\PlantProgressController;
use App\Models\Plant;
use App\Models\User;
use App\Models\PlantCategory;
use App\Models\PlantProgress;

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
        $plants = Plant::with('category')->get();
        return view('gallery', compact('plants'));
    })->name('gallery');
    Route::get('/gallery', [PlantController::class, 'gallery'])->name('gallery');
    Route::get('/plants/{id}/pdf', [PlantController::class, 'exportPdf'])->name('plants.pdf');
    Route::get('/plants/{id}/infor', [PlantController::class, 'exportInfor'])->name('plants.infor');




    Route::prefix('plants')->name('plants.')->group(function () {
        Route::get('/show/{id}', [PlantController::class, 'show'])->name('show');
    });

});


Route::middleware('isAdmin')->prefix('/admin')->name('admin.')->group(function() {
    Route::get('/plants/chart-location', [PlantController::class, 'chartLocation'])->name('plants.chart-location');
    Route::get('/plants/chart', [PlantController::class, 'dataChart'])->name('plants.chart');
    Route::get('/dashboard', function() {
        $totalPlants = Plant::count();
        $totalUsers = User::count();
        $totalCategories = PlantCategory::count();
        $totalProgresses =PlantProgress::count();

    return view('admin.dashboard', compact('totalPlants', 'totalUsers', 'totalCategories', 'totalProgresses'));
    })->name('dashboard');

Route::prefix('plants')->name('plants.')->group(function() {
    Route::get('/', [PlantController::class, 'index'])->name('index');
    Route::get('/create', [PlantController::class, 'create'])->name('create');

    Route::post('/store', [PlantController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [PlantController::class, 'edit'])->name('edit');
    Route::put('/update/{id}', [PlantController::class, 'update'])->name('update');
    Route::delete('/delete/{id}', [PlantController::class, 'destroy'])->name('delete');

    Route::get('/export', [PlantController::class, 'exportExcel'])->name('export');
    Route::get('/trash', [PlantController::class, 'trash'])->name('trash');
    Route::patch('/restore/{id}', [PlantController::class, 'restore'])->name('restore');
    Route::delete('/delete-permanent/{id}', [PlantController::class, 'deletePermanent'])->name('delete_permanent');


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
    Route::get('/trash', [PlantCategoryController::class, 'trash'])->name('trash');
    Route::patch('/restore/{id}', [PlantCategoryController::class, 'restore'])->name('restore');
    Route::delete('/delete-permanent/{id}', [PlantCategoryController::class, 'deletePermanent'])->name('delete_permanent');

});

Route::prefix('users')->name('users.')->group(function() {
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/create', function() {
        return view('admin.users.create');
    })->name('create');
    Route::post('/store', [UserController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit');
    Route::put('/update/{id}', [UserController::class, 'update'])->name('update');
    Route::delete('/delete/{id}', [UserController::class, 'destroy'])->name('delete');
});

});

Route::middleware('isStaff')->prefix('/staff')->name('staff.')->group(function() {
Route::get('/dashboard', function() {
        $totalPlants = Plant::count();
        $totalUsers = User::count();
        $totalCategories = PlantCategory::count();

    return view('staff.dashboard', compact('totalPlants', 'totalUsers', 'totalCategories'));
    })->name('dashboard');

Route::prefix('progresses')->name('progress.')->group(function(){
    Route::get('/', [PlantProgressController::class, 'index'])->name('index');
    Route::post('/store', [PlantProgressController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [PlantProgressController::class, 'edit'])->name('edit');
    Route::put('/update/{id}', [PlantProgressController::class, 'update'])->name('update');
    Route::delete('/delete/{id}', [PlantProgressController::class, 'destroy'])
    ->name('delete');
    Route::get('/trash', [PlantController::class, 'trash'])->name('trash');
    Route::patch('/restore/{id}', [PlantController::class, 'restore'])->name('restore');
    Route::delete('/delete-permanent/{id}', [PlantController::class, 'deletePermanent'])->name('delete_permanent');
});
});
