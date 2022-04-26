<?php

namespace App\Http\Controllers;

use App\Http\Resources\NewsResource;
use App\Models\News;
use App\OpenApi\Responses\NotFoundResponse;
use App\OpenApi\Responses\ShowNewsResponse;
use Carbon\Carbon;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

#[OpenApi\PathItem]
class NewsApiController extends Controller
{
    /**
     * @return Responsable
     */
    #[OpenApi\Operation]
    public function index(){
        $news_list = NewsResource::collection(
            News::query()->published()->paginate(5)
        );
        return view('news_list',['news_list' => $news_list]);
    }

    /**
        *@param string $slug
        *@return Responsable
     */
    #[OpenApi\Operation]
    #[OpenApi\Response(factory: ShowNewsResponse::class, statusCode: 200)]
    #[OpenApi\Response(factory: NotFoundResponse::class, statusCode: 404)]
    public function show(string $slug)
    {
        $news =  new NewsResource(
            News::query()->published()->where('slug', $slug)->firstOrFail()
        );

        return view('news',['news' => $news]);
    }

}
