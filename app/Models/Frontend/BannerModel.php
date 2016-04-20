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
                'banner_status' => 1
            ),
            'limit' => array($this->BANNER_MAX)
        );
        return $this->find('all', $options);
    }

}
