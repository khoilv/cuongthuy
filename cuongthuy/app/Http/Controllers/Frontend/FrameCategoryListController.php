<?php

/**
 * @author LinhNV
 * @version 1.00
 * @create 2015/01/15
 */

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Frontend\CategoryModel;

class FrameCategoryListController extends Controller {
    
    public static function getList() {
        $model = new CategoryModel();
        $categories = $model->getData();
        
        return view('Frontend.category_list', compact('categories'));
    }
}
