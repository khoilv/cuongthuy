<?php

/**
 * @author LanNT
 * @version 1.00
 * @create 2015/12/10
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\CategoryModel;
use App\Models\AutoGenerate;
use Request;

class CategoryController extends Controller {

    private $categoryCls;

    public function __construct() {
        $this->categoryCls = new CategoryModel();
    }

    public function getIndex() {
        $parentList = $this->categoryCls->getParentList();
        $childList = $this->categoryCls->getChildList();
        return view('Admin.category.index', [
            'parentList' => $parentList,
            'childList' => $childList,
        ]);
    }

    public function procAjax() {
        if (Request::has('name')) {
            $data = Request::all();
            extract($data);
            switch ($name) {
                case "insert":
                    $insertArray = array(
                        'category_name' => $category_master_name,
                        'category_parent' => $category_master_id_parent,
                        'category_code' => 'CTG' . AutoGenerate::generateUniqueDigital()
                    );
                    $this->categoryCls->insert($insertArray);
                    $data['category_master_id'] = $this->categoryCls->getIdMax('id');
                    if ($category_master_id_parent != 0) {
                        $data['parent_name'] = $this->categoryCls->getCategoryNameById($category_master_id_parent);
                    }
                    break;
                case "update":
                    $this->categoryCls->update(array('category_name' => $category_master_name), array('id' => $category_master_id));
                    break;
                case "delete":
                    $this->categoryCls->delete(array('id' => $category_master_id));
                    $this->categoryCls->delete(array('category_parent' => $category_master_id));
                    break;
            }
            $data['errno'] = 0;
            print json_encode($data);
        }
    }

}
