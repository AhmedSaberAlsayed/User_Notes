<?php

use App\Http\Controllers\Notes\NotesController;
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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::group(['prefix'=>'notes','middleware'=>'auth'],function(){
    Route::get('indexall', [NotesController::class,'indexall'])->name('notes.indexall');
Route::get('index',[NotesController::class, 'index'])->name('notes.index');
Route::get('create',[NotesController::class,'create'])->name('notes.create');
Route::post('store',[NotesController::class,'store'])->name('notes.store');
Route::post('delete/{notes_id}',[NotesController::class,'delete'])->name('notes.delete');
Route::get('edit',[NotesController::class,'edit'])->name('notes.edit');
Route::post('update',[NotesController::class,'update'])->name('notes.update');
});



require __DIR__.'/auth.php';
