<?php


use App\Http\Controllers\ConnectionServiceController;
use App\Http\Controllers\JobsController;
use App\Http\Controllers\OurPropertyUser;
use App\Http\Controllers\TicketController;
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
    if (Auth::user()) {
        return redirect('tickets');
    } else {
        return redirect('login');
        // return Inertia::render('Welcome', [
        //     'canLogin' => Route::has('login'),
        //     'canRegister' => Route::has('register'),
        // ]);
    }
});





Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/dashboard', function () {
        return redirect('/tickets');
    })->name('dashboard');


    // Route::get('/jobs', function (Request $request) {
    //     return Inertia::render('Jobs/Find', [
    //         'name' => 'Jason',
    //         'param_code' => $request->code,
    //     ]);
    // })->name('jobs');
    Route::get('/tickets', [TicketController::class, 'index']);
    Route::get('/ticket/{ticket}', [TicketController::class, 'show']);
    Route::get('/jobs', [JobsController::class, 'index']);
    Route::get('/job/{job}', [JobsController::class, 'show']);
    Route::get('/users', [OurPropertyUser::class, 'index']);
    Route::get('/user/{user_id}', [OurPropertyUser::class, 'show']);
    Route::post('/user/getProperties', function (Request $request) {
        $response = Http::withToken(Auth::user()->currentTeam->access_token)->acceptJson()
            ->get('https://propertymanager.our.property/api/GetPropertyInfo', [
                'TenantID' => $request->user_id
            ]);
        if ($response->successful()) {
            return $response->object()->data;
            return Inertia::render('Users/Show', [
                'properties' => $response->object()->data
            ]);
        } else {
            return redirect('/auth/refresh');
        }
    });
    Route::post('/user/getTenancy', function (Request $request) {
        $response = Http::withToken(Auth::user()->currentTeam->access_token)->acceptJson()
            ->get('https://propertymanager.our.property/api/GetTenantInfo', [
                'UserID' => $request->user_id
            ]);

        if ($response->successful()) {
            return $response->object()->data;
            return Inertia::render('Users/Show', [
                'tenancy' => $response->object()->data
            ]);
        } else {
            return redirect('/auth/refresh');
        }
    });



    Route::get('/tinkering', function () {

        $response = Team::find(1);
        return $response;
    });

    Route::get('/authenticated', [ConnectionServiceController::class, 'get_token'])->name('authenticated');
    Route::get('/auth/refresh', [ConnectionServiceController::class, 'refresh_token'])->name('refresh_auth');
    Route::get('/test_connection', [ConnectionServiceController::class, 'test_connection'])->name('test_connection');
});
