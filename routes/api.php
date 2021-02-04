<?php

use App\Models\Link;
use Illuminate\Http\Request;
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

Route::domain(config('api.domain'))->group(function () {
    Route::get('/shorten', function (Request $request) {
        $request->validate([
            'target' => ['required', 'url'],
            'type'   => ['required'],
        ]);

        $code = Str::random(8);

        while (Link::query()->where('code', $code)->exists()) {
            $code = Str::random(8);
        }

        return Link::create($request->only('target', 'type') + ['code' => $code]);
    });
});
