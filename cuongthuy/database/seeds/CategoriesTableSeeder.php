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
                    array('category_name' => 'Mỹ phẩm','category_parent' => 0, 'category_code'=> 'CTG'.substr(number_format(time() * uniqid(rand()), 0, '', ''), 0, 6)),
                    array('category_name' => 'Chăm sóc sức khoẻ','category_parent' => 0,'category_code'=> 'CTG'.substr(number_format(time() * uniqid(rand()), 0, '', ''), 0, 6)),
                    array('category_name' => 'Hàng tiêu dùng','category_parent' => 0,'category_code'=> 'CTG'.substr(number_format(time() * uniqid(rand()), 0, '', ''), 0, 6)),
                    array('category_name' => 'Phụ kiện-Thời trang','category_parent' => 0,'category_code'=> 'CTG'.substr(number_format(time() * uniqid(rand()), 0, '', ''), 0, 6)),
                    array('category_name' => 'Mascara','category_parent' => 4,'category_code'=> 'CTG'.substr(number_format(time() * uniqid(rand()), 0, '', ''), 0, 6)),
                    array('category_name' => 'Phấn hồng','category_parent' => 1,'category_code'=> 'CTG'.substr(number_format(time() * uniqid(rand()), 0, '', ''), 0, 6)),
                    array('category_name' => 'Son môi','category_parent' => 1,'category_code'=> 'CTG'.substr(number_format(time() * uniqid(rand()), 0, '', ''), 0, 6)),
                    array('category_name' => 'Dầu gội','category_parent' => 1,'category_code'=> 'CTG'.substr(number_format(time() * uniqid(rand()), 0, '', ''), 0, 6)),
                    array('category_name' => 'Sữa tắm','category_parent' => 1,'category_code'=> 'CTG'.substr(number_format(time() * uniqid(rand()), 0, '', ''), 0, 6)),
                    array('category_name' => 'Chăm sóc tóc','category_parent' => 1,'category_code'=> 'CTG'.substr(number_format(time() * uniqid(rand()), 0, '', ''), 0, 6)),
                    array('category_name' => 'Dầu gội','category_parent' => 10,'category_code'=> 'CTG'.substr(number_format(time() * uniqid(rand()), 0, '', ''), 0, 6)),
                    array('category_name' => 'Hấp ủ tinh chất dưỡng','category_parent' => 10,'category_code'=> 'CTG'.substr(number_format(time() * uniqid(rand()), 0, '', ''), 0, 6)),
                    array('category_name' => 'Dầu xả','category_parent' => 10,'category_code'=> 'CTG'.substr(number_format(time() * uniqid(rand()), 0, '', ''), 0, 6)),
                    array('category_name' => 'Gôm - Gel uốn tóc','category_parent' => 10,'category_code'=> 'CTG'.substr(number_format(time() * uniqid(rand()), 0, '', ''), 0, 6)),
                    array('category_name' => 'Nhuộn tóc','category_parent' => 10,'category_code'=> 'CTG'.substr(number_format(time() * uniqid(rand()), 0, '', ''), 0, 6)),
                    array('category_name' => 'Bột giặt','category_parent' => 3,'category_code'=> 'CTG'.substr(number_format(time() * uniqid(rand()), 0, '', ''), 0, 6)),
                    array('category_name' => 'Bỉm','category_parent' => 3,'category_code'=> 'CTG'.substr(number_format(time() * uniqid(rand()), 0, '', ''), 0, 6)),
                    array('category_name' => 'Bỉm người lớn','category_parent' => 17,'category_code'=> 'CTG'.substr(number_format(time() * uniqid(rand()), 0, '', ''), 0, 6)),
                    array('category_name' => 'Bỉm trẻ em','category_parent' => 17,'category_code'=> 'CTG'.substr(number_format(time() * uniqid(rand()), 0, '', ''), 0, 6)),
                    array('category_name' => 'Đồ gia dụng','category_parent' => 3,'category_code'=> 'CTG'.substr(number_format(time() * uniqid(rand()), 0, '', ''), 0, 6)),
                    array('category_name' => 'Túi xách','category_parent' => 4,'category_code'=> 'CTG'.substr(number_format(time() * uniqid(rand()), 0, '', ''), 0, 6)),
                    array('category_name' => 'Mũ thời trang','category_parent' => 4,'category_code'=> 'CTG'.substr(number_format(time() * uniqid(rand()), 0, '', ''), 0, 6)),
                    array('category_name' => 'Bikini','category_parent' => 4,'category_code'=> 'CTG'.substr(number_format(time() * uniqid(rand()), 0, '', ''), 0, 6)),
                    array('category_name' => 'Phụ kiện','category_parent' => 4,'category_code'=> 'CTG'.substr(number_format(time() * uniqid(rand()), 0, '', ''), 0, 6)),
        );
        DB::table('categories')->insert($post);
    }
}
