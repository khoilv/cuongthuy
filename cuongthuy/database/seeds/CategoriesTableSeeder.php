<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class CategoriesTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
    public function run() {
        DB::table('categories')->truncate();     // clear data in table
        $faker = Faker\Factory::create();
        $post = array(
                    array('name' => 'Mỹ phẩm','parent' => 0),
                    array('name' => 'Chăm sóc sức khoẻ','parent' => 0),
                    array('name' => 'Hàng tiêu dùng','parent' => 0),
                    array('name' => 'Mẹ và bé','parent' => 0),
                    array('name' => 'Bỉm','parent' => 4),
                    array('name' => 'Làm đẹp','parent' => 1),
                    array('name' => 'Sữa rửa mặt','parent' => 1),
                    array('name' => 'Trang điểm','parent' => 1),
        );
        DB::table('categories')->insert($post);
    }
}
