<?php

namespace App\Http\Controllers;

use App\Models\Link;

class TrackingShortcodeController extends Controller
{
    public function __invoke(Link $link)
    {
        if ($link->type !== 'track') {
            abort(404);
        }

        $link->visits += 1;
        $link->save();

        return redirect($link->target, 301);
    }
}
