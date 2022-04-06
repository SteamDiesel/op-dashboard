<?php


use App\Http\Controllers\ConnectionServiceController;
use App\Http\Controllers\JobsController;
use App\Models\Team;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    // Route::get('/jobs', function (Request $request) {
    //     return Inertia::render('Jobs/Find', [
    //         'name' => 'Jason',
    //         'param_code' => $request->code,
    //     ]);
    // })->name('jobs');
    Route::get('/jobs', [JobsController::class, 'index']);
    Route::get('/job/{job}', [JobsController::class, 'show']);



    Route::get('/tinkering', function () {
        $response = Team::find(1);
        return $response;
    });

    Route::get('/authenticated', [ConnectionServiceController::class, 'get_token'])->name('authenticated');
    Route::get('/auth/refresh', [ConnectionServiceController::class, 'refresh_token'])->name('refresh_auth');
    Route::get('/test_connection', [ConnectionServiceController::class, 'test_connection'])->name('test_connection');
});
