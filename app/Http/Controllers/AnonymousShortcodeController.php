<?php

namespace App\Http\Controllers;

use App\Models\Link;

class AnonymousShortcodeController extends Controller
{
    public function __invoke(Link $link)
    {
        if ($link->type !== 'anon') {
            abort(404);
        }

        return redirect($link->target, 301);
    }
}
