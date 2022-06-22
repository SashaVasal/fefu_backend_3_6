<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CatalogFormRequest;
use App\Http\Resources\ListProductResource;
use App\Http\Resources\DetailedProductResource;
use App\Models\Product;
use App\OpenApi\Parameters\DetailProductParameters;
use App\OpenApi\Parameters\ListProductParameters;
use App\OpenApi\Responses\NotFoundResponse;
use App\OpenApi\Responses\DetailProductResponse;
use App\OpenApi\Responses\ListProductResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\HigherOrderTapProxy;
use Throwable;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

#[OpenApi\PathItem]
class ProductController extends Controller
{

    /**
     * Display a paginated list of category products.
     *
     * @param CatalogFormRequest $request
     * @return ListProductResponse|AnonymousResourceCollection|HigherOrderTapProxy|mixed
     */
    #[OpenApi\Operation(tags: ['product'], method: 'GET')]
    #[OpenApi\Response(factory: ListProductResponse::class, statusCode: 200)]
    #[OpenApi\Response(factory: NotFoundResponse::class, statusCode: 404)]
    #[OpenApi\Parameters(factory: ListProductParameters::class)]
    public function index(CatalogFormRequest $request) : mixed
    {
        $requestData = $request->validated();


        $requestData['slug'] = $requestData['category_slug'] ?? null;
        try {
            $data = Product::findProducts($requestData);
        } catch (Throwable $e) {
            abort(422, $e->getMessage());
        }

        return ListProductResource::collection(
            $data['product_query']->orderBy('products.id')->paginate()->appends([
                'category_slug' => $data['key_params']['category_slug'],
                'search_query' => $data['key_params']['search_query'],
                'filters' => $data['key_params']['filters'],
                'sort_mode' => $data['key_params']['sort_mode']
            ])
        )->additional($data['filters']);
    }

    /**
     * Display the specified product with attributes and description.
     *
     * @param Request $request
     * @return DetailedProductResource
     */
    #[OpenApi\Operation(tags: ['product'], method: 'GET')]
    #[OpenApi\Response(factory: DetailProductResponse::class, statusCode: 200)]
    #[OpenApi\Response(factory: NotFoundResponse::class, statusCode: 404)]
    #[OpenApi\Parameters(factory: DetailProductParameters::class)]
    public function show($request)
    {

        $slug = $request->query('product_slug');
        $product = Product::query()
            ->with('productCategory', 'sortedAttributeValues.productAttribute')
            ->where('slug', $slug)
            ->first();

        if($product == null){
            abort(404);
        }

        return new DetailedProductResource(
            $product
        );
    }
}
