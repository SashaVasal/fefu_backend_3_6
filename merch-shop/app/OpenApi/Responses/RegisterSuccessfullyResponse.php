<?php

namespace App\OpenApi\Responses;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;

class RegisterSuccessfullyResponse extends ResponseFactory
{
    public function build(): Response
    {
        return Response::ok()->description('Successful response');
    }
}
