<?php

use App\Http\Controllers\LeagueController;
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

    Route::prefix('/leagues')
        ->name('leagues.')
        ->controller(LeagueController::class)
        ->group(function () {
            Route::get('/', "index")->name('index');
            Route::get('/{league_id}', 'read')->name('read');
            Route::post('/', 'create')->name('create');
            Route::put('/{league_id}', 'update')->name('update');
            Route::delete('/{league_id}', 'delete')->name('delete');

            Route::prefix('/{league_id}/teams')
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
                            Route::post('/', 'create')->name('create');
                            Route::put('/', 'update')->name('update');
                            Route::delete('/', 'delete')->name('delete');
                        });

                    Route::prefix('/{team_id}/players')
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
});
