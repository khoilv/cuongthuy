<?php namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Models\Frontend\CategoryModel;
class MenuController extends Controller {
     public static function getMenu(){
         $categoryCls = new CategoryModel();
         $arrParentList = $categoryCls->getParentList();
         $arrChirdList = $categoryCls->getChildList();
         return view('Frontend.menu',[
             'arrParentList' => $arrParentList,
             'arrChirdList'  => $arrChirdList,
         ]);
     }
}