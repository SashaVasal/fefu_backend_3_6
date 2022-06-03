<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class CatalogController extends Controller
{
    /**
     * Display catalog of product categories.
     *
     * @param string $slug
     * @return Application|Factory|View
     */
    public function index(string $slug = null): View|Factory|Application
    {
        $query = ProductCategory::query()->with('children');

        if ($slug === null) {
            $query->where('parent_id');
        } else {
            $query->where('slug', $slug)->first();
        }


        return view('catalog.catalog', ['categories' => $query->get()]);
    }
}
