<?php
namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use Input;
use DB;
use Request;
    
class RatingController extends Controller {
    
    protected static $productRating;
    protected static $countRating;
    protected static $countStar;
    
    public function __construct() {
        self::$countRating = 0;
        self::$productRating = DB::table('productrating')->where('product_id', Input::get('product_id'))->get();
    }
    public function getRating () {
        //Get product rating
        $average = 0;
        $productRating = self::$productRating;
        if (!empty($productRating)) {
            $sum = 0;
            if (count($productRating)) {
                for ($i = 1; $i <= 5; $i++) {
                    $star = "count_start_".$i;
                    $sum += $i*$productRating[0]->$star;
                    self::$countRating += $productRating[0]->$star;
                }
            }
            $average = $sum/self::$countRating;
        }
        if (!$average) {
            $average = 5;
        }
        return $average;
    }
    
    public function updateRating () {
        if(Request::ajax()) {
            $data = Input::all();
            if (!empty(self::$productRating)) {
                $a = "count_start_".$data['rating'];
                self::$productRating[0]->$a += 1;
                DB::table('productrating')
                        ->where('product_id', $data['product_id'])
                        ->update(array("count_start_".$data['rating'] => self::$productRating[0]->$a));
            } else {
                DB::table('productrating')->insert(
                    array('product_id' => $data['product_id'], "count_start_".$data['rating'] => 1)
                );
            }
        }
    }
}
