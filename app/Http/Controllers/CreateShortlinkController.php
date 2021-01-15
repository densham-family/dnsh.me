<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CreateShortlinkController extends Controller
{
    public function __invoke(Request $request)
    {
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
    }
}
