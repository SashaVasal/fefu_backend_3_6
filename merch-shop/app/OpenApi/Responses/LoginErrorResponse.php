<?php

namespace App\OpenApi\Responses;

use App\OpenApi\Schemas\AppealFailedSchema;
use App\OpenApi\Schemas\LoginErrorSchema;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;

class LoginErrorResponse extends ResponseFactory
{
    public function build(): Response
    {
        return Response::unprocessableEntity()->description('Failed response')->content(
            MediaType::json()->schema(
                LoginErrorSchema::ref()
            )
        );
    }
}
