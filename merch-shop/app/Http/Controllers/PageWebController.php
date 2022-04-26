<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PageWebController extends Controller
{

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
