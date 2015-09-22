<?php namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Models\Frontend\BannerModel;
class ProductController extends Controller {
     public static function getIndex(){
         $bannerCls = new BannerModel();
         $arrBannerList = $bannerCls->getBannerList();
         return view('Frontend.list',[
             'arrBannerList' => $arrBannerList,
         ]);
     }
}