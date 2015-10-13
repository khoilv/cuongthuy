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
        // get list category
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
     * Get category parrent
     * @return array $this->parentList
     */
    
     public function getParentList() {
        return $this->parentList;
    }

    /**
     * Get category chid
     * @return array $this->childList 
     */
    public function getChildList() {
        return $this->childList;
    }

    /**
     * Get category_name by category_id
     * @param int $id
     * @return string
     */
    public function getCategoryNamebyId($id){
        $options = array(
            'fields' => array('category_name'),
            'conditions' => array('id' => $id),
        );
        $result = $this->find('first', $options);
        return $result['category_name'];
    }
}