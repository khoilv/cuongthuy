<?php namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Models\Frontend\BannerModel;
class BannerController extends Controller {
     public static function getBanner(){
         $bannerCls = new BannerModel();
         $arrBannerList = $bannerCls->getBannerList();
         return view('Frontend.banner',[
             'arrBannerList' => $arrBannerList,
         ]);
     }
}