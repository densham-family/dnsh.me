<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        $links = Link::query()
            ->when($request->has('sort_by'), function (Builder $query) use ($request) {
                $query
                    ->orderBy($request->input('sort_by'), $request->input('sort', 'ASC'))
                    ->orderBy('type', 'DESC');
            })
            ->get();

        return view('dashboard', [
            'links' => $links,
        ]);
    }
}
