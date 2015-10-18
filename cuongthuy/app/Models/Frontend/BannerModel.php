<?php
namespace App\Models\Frontend;
use App\Models\TableBase;
class BannerModel extends TableBase {

    protected $table = 'banner';
    protected $parentList = array();
    protected $childList = array();
    private $BANNER_MAX = 5;

    public function __construct() {
        parent::__construct();
        $this->setTableName($this->table);
    }

    /**
     * Get list banner
     * @return array
     */
    
     public function getBannerList() {
        $options = array(
            'fields' => array('*'),
            'conditions' => array(
                'banner_expires_date >=' => date('Y-m-d H:i:s'),
                'banner_status' => 1,
                'banner_date_added <=' => date('Y-m-d H:i:s'),
                ),
            'limit'  => array($this->BANNER_MAX)
        );
        return $this->find('all', $options);
    }
}