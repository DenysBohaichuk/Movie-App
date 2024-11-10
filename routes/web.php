<?php

use App\Http\Controllers\Admin\TagController;
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

Route::view('/', 'welcome')->name('welcome');



Route::post('/locale', function () {
    $locale = request('locale');

    if (in_array($locale, ['en', 'ua'])) {
        setcookie('locale', $locale, time() + (10 * 365 * 24 * 60 * 60), '/');
    }

    return redirect()->back();
})->name('locale.change');




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::prefix('admin')->name('admin.')->middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'admin.dashboard')->name('dashboard');
    Route::resource('movies', \App\Http\Controllers\Admin\MovieController::class);
    Route::resource('tags', TagController::class);
});


Route::get('/movies', [\App\Http\Controllers\Client\MovieController::class, 'index'])->name('client.movies.index');
Route::get('/movies/{movie}', [\App\Http\Controllers\Client\MovieController::class, 'show'])->name('client.movies.show');
