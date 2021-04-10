<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Establishment\EstablishmentController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

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
