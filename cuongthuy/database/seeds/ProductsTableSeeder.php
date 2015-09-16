<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class ProductsTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
    public function run() {
        DB::table('products')->truncate();     // clear data in table
        $faker = Faker\Factory::create();
        for ( $i=1; $i<=100; $i++ ) {
            $post = [
                    'product_name'     => $faker->text(rand(20, 50)),
                    'product_code'     => 'SP'.(rand(10, 170)),
                    'product_status'   => rand(1,3),
                    'product_category' => rand(1,10),
                    'product_image'       => 'image'.$i.'.jpg',
                    'product_other_image'     => '',
                    'product_short_description'   => $faker->text(rand(50, 100)),
                    'product_description' => $faker->text(rand(100, 300)),
                    'product_quantity' => rand(1,20),
                    'product_rating' => rand(1,50),
                    'product_price' => rand(100,500)
                ];
            $posts[] = $post;
        }
        DB::table('products')->insert($posts);
    }
}
