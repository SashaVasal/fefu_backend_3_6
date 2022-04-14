<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PageWebController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function __invoke(Request $request, string $slug)
    {
        $page = Page::query()
            ->where('slug', $slug)
            ->first();
        if ($page === null)
        {
            abort(404);
        }
        return view('page', ['page' => $page]);
    }
}
