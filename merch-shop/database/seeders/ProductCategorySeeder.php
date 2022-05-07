<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    private const DEPTH = 4;

    public function run()
    {
        ProductCategory::query()->delete();
        $this->seedChildren(ProductCategory::factory(random_int(1,3))->create()->pluck('id'));
    }

    /**
     * @throws \Exception
     */
        private function seedChildren(iterable $parentIds, int $depth = 1):void{
        if($depth > self::DEPTH){
            return;
        }

        foreach($parentIds as $parentId){
            $this->seedChildren(
                ProductCategory::factory(random_int(1,3))->child($parentId)->create()->pluck('id'),
                ++$depth
            );
        }
    }
}
