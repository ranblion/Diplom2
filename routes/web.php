<?php

use App\Http\Controllers;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/documents/search', [Controllers\DocumentController::class, 'search'])->name('documents.search');
Route::get('/documents/{id}', [Controllers\DocumentController::class, 'show'])->name('documents.show');
Route::get('/documents/download/{id}', [Controllers\DocumentController::class, 'download'])->name('documents.download');
Route::post('/documents/upload', [Controllers\DocumentController::class, 'upload'])->name('documents.upload');
Route::resources(['documents' => Controllers\DocumentController::class,]);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['role:admin'])->prefix('admin_panel')->group( function () {
    Route::get('/', [App\Http\Controllers\Admin\HomeController::class , 'index']);
});

require __DIR__.'/auth.php';
