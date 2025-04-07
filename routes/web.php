<?php

use App\Http\Controllers\CandidatoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NotificacionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VacanteController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');

Route::get('/dashboard', [VacanteController::class, 'index'])->middleware(['auth', 'verified', 'checkUserRole'])
    ->name('vacantes.index');
Route::get('/vacante/crear', [VacanteController::class, 'create'])->middleware(['auth', 'verified'])->name('vacantes.create');
Route::get('/vacante/{vacante}/edit', [VacanteController::class, 'edit'])->middleware(['auth', 'verified'])->name('vacantes.edit');
Route::get('/vacante/{vacante}', [VacanteController::class, 'show'])->name('vacantes.show');
Route::get('/notificaciones', NotificacionController::class)->middleware(['auth', 'verified', 'checkUserRole'])->name('notificaciones');
Route::get('/candidato/{vacante}', [CandidatoController::class,'index'])->name('candidatos.index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__ . '/auth.php';
