<?php

namespace App\OpenApi\Responses;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;

class LogoutErrorResponse extends ResponseFactory
{
    public function build(): Response
    {
        return Response::ok()->description('You were not logged in');
    }
}
