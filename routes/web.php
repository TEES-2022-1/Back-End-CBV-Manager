<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('images/{filename}', function($filename) {
    $filepath = storage_path("app/images/{$filename}");
    if (file_exists($filepath)) {
        return response()->file($filepath, ['Content-Type' => mime_content_type($filepath)]);
    }

    return response()->noContent(404);
})->name('images');
