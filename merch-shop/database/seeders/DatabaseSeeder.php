<?php

namespace Database\Seeders;

use App\Enums\ProductAttributeType;
use App\Models\ProductAttribute;
use App\Models\ProductCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call([
            PageSeeder::class,
            ProductCategorySeeder::class,
            NewsSeeder::class,
            ProductCategorySeeder::class,
            ProductAttributeSeeder::class,
            ProductSeeder::class,
            ProductAttributeValueSeeder::class,
        ]);
    }
}
