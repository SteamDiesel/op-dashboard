<?php


use App\Http\Controllers\ConnectionServiceController;
use App\Http\Controllers\JobsController;
use App\Http\Controllers\OurPropertyUser;
use App\Http\Controllers\TicketApiController;
use App\Http\Controllers\TicketController;
use App\Mail\TestMail;
use App\Models\Team;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
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

    // Tickets
    Route::get('/tickets', [TicketController::class, 'index']);
    Route::get('/tickets/closed', [TicketController::class, 'closed_index']);
    Route::get('/tickets/team', [TicketController::class, 'team_index']);
    Route::get('/tickets/team/closed', [TicketController::class, 'team_closed_index']);
    Route::get('/ticket/{ticket}', [TicketController::class, 'show']);

    Route::get('/tickets/new', [TicketController::class, 'create']);
    Route::post('/ticket/update/{ticket}', [TicketController::class, 'update']);

    // Ticket API Post Calls
    Route::post('/ticket/api/getUser', [OurPropertyUser::class, 'fetch']);
    Route::post('/ticket/api/mergeTradies', [TicketApiController::class, 'mergetradies']);


    // Jobs
    Route::get('/jobs', [JobsController::class, 'index']);
    Route::get('/job/{job}', [JobsController::class, 'show']);

    // Users
    Route::get('/users', [OurPropertyUser::class, 'index']);
    Route::get('/user/{user_id}', [OurPropertyUser::class, 'show']);
    Route::post('/user/getProperties', [OurPropertyUser::class, 'properties']);
    Route::post('/user/getTenancy', [OurPropertyUser::class, 'tenancies']);
    Route::post('/getAgency', [OurPropertyUser::class, 'agency']);



    Route::get('/tinkering', function () {

        $response = Team::find(1);
        return $response;
    });
    Route::get('/test_email', function () {
        $em = Auth::user()->email;
        // return $em;
        Mail::to($em)->send(new TestMail());

        return 'a test email was sent to you, check your inbox.';
    });

    Route::get('/AutoLogin', function () {
        $token = env('APP_AUTO_LOGIN_TOKEN');
        $response = Http::post('https://propertymanager.our.property/api/getAutoLogin', [
            'special_token' => $token,
            'UserID' => 75996
        ]);
    });

    Route::get('/auth/connect', [ConnectionServiceController::class, 'connect'])->name('connect');
    Route::get('/authenticated', [ConnectionServiceController::class, 'get_token'])->name('authenticated');
    Route::get('/auth/refresh', [ConnectionServiceController::class, 'refresh_token'])->name('refresh_auth');
    Route::get('/test_connection', [ConnectionServiceController::class, 'test_connection'])->name('test_connection');
});
