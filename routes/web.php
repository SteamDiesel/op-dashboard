<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});





Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function (Request $request) {

        return Inertia::render('Dashboard', [
            'name' => 'Jason',
            'param_code' => $request->code,
        ]);
    })->name('dashboard');
    // Route::get('/tinkering', function () {
    //     $response = Http::get('http://example.com');
    //     return $response;
    // });
    Route::get('/tinkering', function () {
        return Inertia::render('Tinkering');
    })->name('tinkering');

    Route::get('/authenticated', function (Request $request) {
        $response = Http::post('https://propertymanager.our.property/api/token', [
            'code' => $request->code,
            'client_id' => 'A2Ngw83NAX3AY9r9f9xx',
            'client_secret' => 'GpROQY2dkBGASEAASpaJceslGPHsptKL',
            'grant_type' => 'authorization_code',
            'redirect_uri' => 'http://localhost/authenticated'
        ]);
        return $response;
    });
});
