<?php
namespace App\Models\Frontend;
use App\Models\TableBase;
class CategoryModel extends TableBase {

    protected $table = 'categories';
    protected $parentList = array();
    protected $childList = array();

    public function __construct() {
        parent::__construct();
        $this->setTableName($this->table);
        $options = array(
            'fields' => array('*')
        );
        $arrCategory = $this->find('all', $options);
        foreach ( $arrCategory as $arrRow ) {
                if ( $arrRow['category_parent'] == 0 ) {
                    $this->parentList[$arrRow['id']] = $arrRow;
                } else {
                    $this->childList[$arrRow['category_parent']][$arrRow['id']]  = $arrRow;
                }
            }
    }

    /**
     * 
     * @return $this->parentList
     */
    
     public function getParentList() {
        return $this->parentList;
    }

    /**
     * @short 
     *
     * @return $this->childList 
     */
    public function getChildList() {
        return $this->childList;
    }
}