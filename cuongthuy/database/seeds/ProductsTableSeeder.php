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
                    'product_code'     => 'SP'.substr(number_format(time() * uniqid(rand()), 0, '', ''), 0, 6),
                    'product_status'   => rand(1,3),
                    'product_category' => rand(1,10),
                    'product_image'       => 'img'.rand(1,7).'.png',
                    'product_other_image'     => '',
                    'product_short_description'   => $faker->text(rand(50, 100)),
                    'product_description' => $faker->text(rand(100, 300)),
                    'product_quantity' => rand(1,20),
                    'product_price' => rand(100,500).'.000VND',
                    'product_discount_price' => null,
                    'product_discount_flag' => rand(0,1),
                    'product_display' => rand(1,2),
                    'product_type' => rand(1,3),
                    'product_date_added' => new \DateTime(date('Y-m-d H:i:s')),
                    'product_date_modify' => new \DateTime(date('Y-m-d H:i:s')),
                ];
            $posts[] = $post;
        }
        DB::table('products')->insert($posts);
    }
}
