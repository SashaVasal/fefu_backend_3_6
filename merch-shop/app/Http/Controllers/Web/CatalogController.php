<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Throwable;

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
        $query = ProductCategory::query()->with('children', 'products');

        if ($slug === null) {
            $query->where('parent_id');
        } else {
            $query->where('slug', $slug);
        }

        $categories = $query->get();

        try {
            $products = ProductCategory::getTreeProductBuilder($categories)
                ->orderBy('id')->paginate();
        } catch(Throwable $e) {
            abort(422, $e->getMessage());
        }

        return view('catalog.index', ['categories' => $categories, 'products' => $products]);
    }
}
