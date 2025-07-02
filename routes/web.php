<?php

use App\Http\Controllers\AprovacoesController;
use App\Http\Controllers\ProcessosController;
use App\Http\Controllers\SignatariosController;
use App\Http\Controllers\UserController;
use App\Models\Aprovacoes;
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


Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return view('users.auth');
    });
    Route::get('/login', [UserController::class, 'showLoginForm'])->name('login')->name('users.auth');
    Route::post('/login', [UserController::class, 'login'])->name('users.login');
    Route::get('/register', [UserController::class, 'create'])->name('users.create');
    Route::post('/register', [UserController::class, 'store'])->name('users.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/user', [UserController::class, 'show'])->name('users.show');
    Route::get('/user/edit', [UserController::class, 'showUpdateForm'])->name('users.edit');
    Route::put('/user', [UserController::class, 'update'])->name('users.update');
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
    Route::resource('signatarios', SignatariosController::class);
    Route::get('/home', [ProcessosController::class, 'index'])->name('processos.index');
    Route::resource('processos', ProcessosController::class);
    Route::get('/aprovacao/{idProcesso}/{idSignatario}', action: [AprovacoesController::class, 'create'])->name('aprovacoes.create');
    Route::post('/aprovacao', action: [AprovacoesController::class, 'store'])->name('aprovacoes.store');
});
