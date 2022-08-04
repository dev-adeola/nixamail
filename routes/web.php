<?php

use App\Models\Contact;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EditorController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\WhatsappController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/sendmail', [EditorController::class, 'index'])->middleware(['auth'])->name('sendmail');
Route::post('/store', [EditorController::class, 'sendMail'])->middleware(['auth']);
Route::post('/editor/image', [EditorController::class, 'upload'])->middleware(['auth'])->name('upload');
Route::post('/contact', [ContactController::class, 'create'])->middleware(['auth']);

Route::get('/dashboard', [ContactController::class, 'catdetails'])->middleware(['auth'])->name('dashboard');
Route::post('/addcats', [ContactController::class, 'createcats'])->middleware(['auth']);

Route::get('/whatsapp', [WhatsappController::class, 'index'])->middleware(['auth'])->name('whatsapp');
Route::post('/whatsapp', [WhatsappController::class, 'index'])->middleware(['auth']);
Route::get('/', function () {
    return view('welcome');
});
require __DIR__.'/auth.php';
