<?php

/**
 * @author LanNT
 * @version 1.00
 * @create 2015/12/10
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Frontend\CategoryModel;
use Input;
use Session;
use Cache;
use Redirect;

class CategoryController extends Controller
{
    private $categoryCls;

    public function __construct()
    {
        $this->categoryCls = new CategoryModel();
    }

    public function getParentList()
    {
        $parentList = $this->categoryCls->getParentList();
        return view('admin.category.category_parent',[
            'parentList' => $parentList
        ]);
    }
    
    public function getChildList(){
        $parentList = $this->categoryCls->getParentList();
        $childList = $this->categoryCls->getChildList();
        return view('admin.category.category_child',[
            'childList' => $childList,
            'parentList' => $parentList
        ]);
    }
}
