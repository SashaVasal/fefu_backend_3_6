<?php

namespace App\OpenApi\Schemas;

use GoldSpecDigital\ObjectOrientedOAS\Contracts\SchemaContract;
use GoldSpecDigital\ObjectOrientedOAS\Objects\AllOf;
use GoldSpecDigital\ObjectOrientedOAS\Objects\AnyOf;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Not;
use GoldSpecDigital\ObjectOrientedOAS\Objects\OneOf;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Contracts\Reusable;
use Vyuldashev\LaravelOpenApi\Factories\SchemaFactory;

class AppealFailedSchema extends SchemaFactory implements Reusable
{
    /**
     * @return AllOf|OneOf|AnyOf|Not|Schema
     */
    public function build(): SchemaContract
    {
        return Schema::object('AppealFailed')
            ->properties(
                Schema::object('errors')->properties(
                    Schema::array('name')->nullable()->items(Schema::string('description')),
                    Schema::array('phone')->nullable()->items(Schema::string('description')),
                    Schema::array('email')->nullable()->items(Schema::string('description')),
                    Schema::array('message')->nullable()->items(Schema::string('description')),
                )
            );
    }
}
