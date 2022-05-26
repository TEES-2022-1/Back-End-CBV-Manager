<?php

use App\Http\Controllers\CompetitionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::middleware('apiInterceptor')->group(function () {

    Route::prefix('/teams')
        ->name('teams.')
        ->controller(\App\Http\Controllers\TeamController::class)
        ->group(function () {
            Route::get('/', "index")->name('index');
            Route::get('/{team_id}', 'read')->name('read');
            Route::post('/', 'create')->name('create');
            Route::put('/{team_id}', 'update')->name('update');
            Route::delete('/{team_id}', 'delete')->name('delete');

            Route::prefix('/{team_id}/technical_committee')
                ->name('technical_committee.')
                ->controller(\App\Http\Controllers\TechnicalCommitteeController::class)
                ->group(function () {
                    Route::get('/', "index")->name('index');
                    Route::get('/{technical_committee_id}', 'read')->name('read');
                    Route::post('/', 'create')->name('create');
                    Route::put('/{technical_committee_id}', 'update')->name('update');
                    Route::delete('/{technical_committee_id}', 'delete')->name('delete');

                });

        });
    
    Route::prefix('/competitions')
        ->name('competitions.')
        ->controller(CompetitionController::class)
        ->group(function () {
            Route::get('/', "index")->name('index');
            Route::get('/{competition_id}', 'read')->name('read');
            Route::post('/', 'create')->name('create');
            Route::put('/{competition_id}', 'update')->name('update');
            Route::delete('/{competition_id}', 'delete')->name('delete');
        });

    Route::prefix('/positions')
        ->name('positions.')
        ->controller(\App\Http\Controllers\PositionController::class)
        ->group(function () {
            Route::get('/', "index")->name('index');
            Route::get('/{position_id}', 'read')->name('read');
            Route::post('/', 'create')->name('create');
            Route::put('/{position_id}', 'update')->name('update');
            Route::delete('/{position_id}', 'delete')->name('delete');
        });

    Route::prefix('/players')
        ->name('players.')
        ->controller(\App\Http\Controllers\PlayerController::class)
        ->group(function () {
            Route::get('/', "index")->name('index');
            Route::get('/{player_id}', 'read')->name('read');
            Route::post('/', 'create')->name('create');
            Route::put('/{player_id}', 'update')->name('update');
            Route::delete('/{player_id}', 'delete')->name('delete');
        });
});
