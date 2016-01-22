<?php

namespace App\Models\Admin;

use App\Models\TableBase;

class CategoryModel extends TableBase {

    protected $table = 'categories';
    protected $parentList = array();
    protected $childList = array();
    protected $data = array();

    public function __construct() {
        parent::__construct();
        $this->setTableName($this->table);
        $options = array(
            'fields' => array('*'),
        );
        // get list category
        $arrCategory = $this->find('all', $options);
        foreach ($arrCategory as $arrRow) {
            $this->data[$arrRow['id']] = $arrRow;
            if ($arrRow['category_parent'] == 0) {
                $this->parentList[$arrRow['id']] = $arrRow;
            } else {
                $this->childList[$arrRow['category_parent']][] = $arrRow;
            }
        }
    }

    /**
     * Get category parrent
     * @return array $this->parentList
     */
    public function getParentList() {
        $arrParent = array();
        foreach ($this->data as $key => $val) {
            if ($val['category_parent'] !== 0 && isset($this->parentList[$val['category_parent']])) {
                $arrParent[$key] = $val;
            }
        }
        return $this->parentList + $arrParent;
    }

    /**
     * Get category chid
     * @return array $this->childList 
     */
    public function getChildList() {
        return $this->childList;
    }

    public function getCategoryName() {
        $categoryName = array();
        foreach ($this->data as $key => $val) {
            $categoryName[$key] = $val['category_name'];
        }
        return $categoryName;
    }

    public function getCategoryNameById($id) {
        return $this->data[$id]['category_name'];
    }

    public function getParentIdById($id) {
        return $this->data[$id]['category_parent'];
    }

}
