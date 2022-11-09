<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PhodController;


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

// Route::get('/', function () {
//     return view('welcome');
// });

// 「/」にアクセスした場合indexアクションを呼び出す
Route::get('/', [PhodController::class, 'index'])
    ->name('root');
// ->middleware('auth');

//table.blade.php
Route::get('phods/table/', [PhodController::class, 'table'])
    ->name('table');

//contact.blade.php
Route::get('phods/contact/', [PhodController::class, 'contact'])
    ->name('contact');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// 認証していなければアクセスできないように制御
Route::resource('phods', PhodController::class)
    ->only(['store', 'create', 'update', 'destroy', 'edit', 'index', 'show'])
    ->middleware('auth');

//認証していなくてもアクセスできる
// Route::resource('phods', PhodController::class)
//     ->only(['index', 'show']);



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// require __DIR__ . '/auth.php';
