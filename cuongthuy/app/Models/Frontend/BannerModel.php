<?php
namespace App\Models\Frontend;
use App\Models\TableBase;
class BannerModel extends TableBase {

    protected $table = 'banner';
    protected $parentList = array();
    protected $childList = array();

    public function __construct() {
        parent::__construct();
        $this->setTableName($this->table);
    }

    /**
     * 
     * @return 
     */
    
     public function getBannerList() {
        $options = array(
            'fields' => array('*'),
            'conditions' => array('banner_expires_date >=' => date('Y-m-d H:i:s'))
        );
        return $this->find('all', $options);
    }
}