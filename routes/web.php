<?php

use App\Models\Link;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

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

Route::redirect('/', '/login');

Route::get('/dashboard', function (Request $request) {
    $links = Link::query()
        ->when($request->has('sort_by'), function (Builder $query) use ($request) {
            $query->orderBy($request->input('sort_by'), $request->input('sort', 'ASC'))
                ->orderBy('type', 'DESC');
        })
        ->get();

    return view('dashboard', [
        'links' => $links,
    ]);
})->middleware(['auth'])->name('dashboard');

Route::post('/create', function (Request $request) {
    $request->validate([
        'target' => ['required', 'url'],
        'type' => ['required'],
    ]);

    $code = Str::random(8);

    while (Link::query()->where('code', $code)->exists()) {
        $code = Str::random(8);
    }

    Link::create($request->only('target', 'type') + ['code' => $code]);

    return redirect()->back();
})->middleware('auth')->name('create');

Route::get('/t/{link:code}', function (Link $link) {
    if ($link->type !== 'track') {
        abort(404);
    }

    $link->visits += 1;
    $link->save();

    return redirect($link->target, 301);
})->name('shortlink.track');

Route::get('/a/{link:code}', function (Link $link) {
    if ($link->type !== 'anon') {
        abort(404);
    }

    return redirect($link->target, 301);
})->name('shortlink.anon');

require __DIR__.'/auth.php';
