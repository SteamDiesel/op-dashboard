<?php

use App\Models\Team;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('refresh_tokens', function () {
    $redirect = env('APP_URL') . '/authenticated';
    $teams = Team::whereNotNull('refresh_token')->get();

    foreach ($teams as $team) {
        $response = Http::post('https://propertymanager.our.property/api/token', [
            'refresh_token' => $team->refresh_token,
            'client_id' => $team->client_id,
            'client_secret' => $team->client_secret,
            'grant_type' => 'refresh_token',
            'redirect_uri' => $redirect
        ]);

        $team->access_token = $response['access_token'];
        $team->expires_in = $response['expires_in'];
        $team->token_type = $response['token_type'];
        $team->scope = $response['scope'];
        $team->refresh_token = $response['refresh_token'];

        $team->save();
    }
})->purpose('Refresh the Auth Token with the API server.');
