<?php

use App\Http\Controllers\album;
use App\Http\Controllers\collection;
use App\Http\Controllers\general;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/album', [album::class, 'showAlbum'])->name('/album');
Route::post('/addAlbum', [album::class, 'addAlbum'])->name('/addAlbum');
Route::get('/albumDetails/{id}', [album::class, 'albumDetails'])->name('/albumDetails');
Route::delete('/deleteAlbum/{id}', [album::class, 'deleteAlbum'])->name('/deleteAlbum');
Route::get('/editAlbum/{id}', [album::class, 'showEditAlbum'])->name('/editAlbum');
Route::post('/editAlbum/{id}', [album::class, 'editAlbum'])->name('/editAlbum');
Route::get('/searchAlbum', [album::class, 'showSearchAlbum'])->name('/searchAlbum');
Route::post('/searchAlbum', [album::class, 'searchAlbum'])->name('/searchAlbum');

Route::get('/general', [general::class, 'showGeneral'])->name('/general');
Route::post('/addArtist', [general::class, 'addArtist'])->name('/addArtist');
Route::delete('/deleteArtist/{id}', [general::class, 'deleteArtist'])->name('/deleteArtist');
Route::post('/addGenre', [general::class, 'addGenre'])->name('/addGenre');
Route::delete('/deleteGenre/{id}', [general::class, 'deleteGenre'])->name('/deleteGenre');
Route::post('/addLabel', [general::class, 'addLabel'])->name('/addLabel');
Route::delete('/deleteLabel/{id}', [general::class, 'deleteLabel'])->name('/deleteLabel');

Route::get('/collection', [collection::class, 'showCollection'])->name('/collection');
Route::get('/addToCollection/{id}', [collection::class, 'showAddToCollection'])->name('/addToCollection');
Route::post('/addToCollection/{id}', [collection::class, 'addToCollection'])->name('/addToCollection');

require __DIR__.'/auth.php';
