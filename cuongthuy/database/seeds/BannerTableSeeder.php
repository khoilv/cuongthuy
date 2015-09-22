<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class BannerTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
    public function run() {
        DB::table('banner')->truncate();     // clear data in table
        $faker = Faker\Factory::create();
        for ( $i=1; $i<=5; $i++ ) {
            $post = [
                    'banner_title'       => $faker->text(rand(20, 50)),
                    'banner_url'         => 'public/images/upload/banner/banner'.$i.'.jpg',
                    'banner_expires_date'=> new \DateTime(date('Y-m-d H:i:s', time() + 86400 * 60)),
                    'banner_date_added'  => new \DateTime(date('Y-m-d H:i:s')),
                    'banner_status'      => rand(1,2),
					'banner_image_path'  => 'banner'.$i.'.jpg',
                ];
            $posts[] = $post;
        }
        DB::table('banner')->insert($posts);
    }
}
