<?php

namespace App\Http\Controllers\Web;

use App\Filters\ProductFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\CatalogFormRequest;
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
    public function index(CatalogFormRequest $request, $slug = null): View|Factory|Application
    {
        $request_data = $request->validated();

        $query = ProductCategory::query()->with('children', 'products');

        if ($slug === null) {
            $query->where('parent_id');
        } else {
            $query->where('slug', $slug);
        }

        $categories = $query->get();
        $productQuery = ProductCategory::getTreeProductBuilder($categories)
            ->orderBy('id');

        if(isset($request_data['search_query'])){
            $productQuery->search($request_data['search_query']);
        }

        $filters = ProductFilter::build($productQuery, $request_data['filters'] ?? []);

        $sortMode = $request_data['sort_mode'] ?? null;
        if($sortMode == 'price_asc'){
            $productQuery->orderBy('price');
        }else if($sortMode == 'price_desc'){
            $productQuery->orderBy('price','desc');
        }

        try {
            $products = ProductCategory::getTreeProductBuilder($categories)
                ->orderBy('id')->paginate();
        } catch(Throwable $e) {
            abort(422, $e->getMessage());
        }

        return view('catalog.index', [
            'categories' => $categories,
            'products' => $productQuery->orderBy('products.id')->paginate(10),
            'filters' => $filters]);
    }
}
