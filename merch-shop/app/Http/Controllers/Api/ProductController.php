<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ListProductResource;
use App\Http\Resources\DetailedProductResource;
use App\Models\Product;
use App\Models\ProductCategory;
use App\OpenApi\Parameters\DetailProductParameters;
use App\OpenApi\Parameters\ListProductParameters;
use App\OpenApi\Responses\NotFoundResponse;
use App\OpenApi\Responses\DetailProductResponse;
use App\OpenApi\Responses\ListProductResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Throwable;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

#[OpenApi\PathItem]
class ProductController extends Controller
{
    /**
     * Display a paginated list of category products.
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    #[OpenApi\Operation(tags: ['product'], method: 'GET')]
    #[OpenApi\Response(factory: ListProductResponse::class, statusCode: 200)]
    #[OpenApi\Response(factory: NotFoundResponse::class, statusCode: 404)]
    #[OpenApi\Parameters(factory: ListProductParameters::class)]
    public function index(Request $request): AnonymousResourceCollection
    {
        $slug = $request->query('category_slug');
        $categoryQuery = ProductCategory::query()
            ->with('children', 'products');

        if ($slug === null) {
            $categoryQuery->where('parent_id');
        } else {
            $categoryQuery->where('slug', $slug);
        }

        $categories = $categoryQuery->get();
        /** @var Product $products */
        try {
            $products = ProductCategory::getTreeProductBuilder($categories)
                ->orderBy('id')
                ->paginate();
        } catch (Throwable $e) {
            abort(422, $e->getMessage());
        }


        return ListProductResource::collection(
            $products
        );
    }


    #[OpenApi\Operation(tags: ['product'], method: 'GET')]
    #[OpenApi\Response(factory: DetailProductResponse::class, statusCode: 200)]
    #[OpenApi\Response(factory: NotFoundResponse::class, statusCode: 404)]
    #[OpenApi\Parameters(factory: DetailProductParameters::class)]
    public function show($slug): DetailedProductResource
    {

        $product = Product::query()
            ->with('productCategory', 'sortedAttributeValues.productAttribute')
            ->where('slug', $slug)
            ->first();
        return new DetailedProductResource(
            $product
        );
    }
}
