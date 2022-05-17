<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use function abort;
use function view;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request): View|Factory|Application
    {
        $news_list = News::query()
            ->published()
            ->orderBy('published_at', 'desc')
            ->paginate(5);
        return view('news_list', ['news_list' => $news_list]);
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param string $slug
     * @return Application|Factory|View
     */
    public function show(Request $request, string $slug): View|Factory|Application
    {
        $news = News::query()
            ->published()
            ->where('slug', $slug)
            ->first();
        if ($news === null)
        {
            abort(404);
        }
        return view('news', ['news' => $news]);
    }
}
