<?php

use App\Http\Controllers\Api\User\UserController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Establishment\EstablishmentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Auth::routes();


// Rotas de LOGIN e Registro de novo Usuário
Route::post('/login', [UserController::class, 'login'])->name('user.login');
Route::post('/register', [UserController::class, 'register'])->name('user.register');

// Autenticação para Acessar as Rotas

//Route::middleware('auth:sanctum')->group(function () {

    // Rotas Dados de Usuário Logado / Rota Logout
    Route::get('user', [UserController::class, 'user']);
    Route::get('logout', [UserController::class, 'logout'])->name('user.logout');

    // Rotas do CRUD de Estabelecimento
    Route::namespace('Api/Establishment')->group(function () {
        Route::prefix('establishment')->group(function () {

            Route::get('/', [EstablishmentController::class, 'index'])->name('establishment.index');
            Route::post('/', [EstablishmentController::class, 'store'])->name('establishment.store');
            Route::get('/{establishment}', [EstablishmentController::class, 'show'])->name('establishment.show');
            Route::put('/{id}', [EstablishmentController::class, 'update'])->name('establishment.update');
            Route::delete('/{id}', [EstablishmentController::class, 'destroy'])->name('establishment.delete');

        });
    });
//});

