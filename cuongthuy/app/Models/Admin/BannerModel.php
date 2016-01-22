<?php

namespace App\Models\Admin;

use App\Models\TableBase;

class BannerModel extends TableBase {

    protected $table = 'banner';

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
            'fields' => array('*')
        );
        return $this->find('all', $options);
    }

    public function getBannerById($id) {
        $options = array(
            'fields' => array('*'),
            'conditions' => array(
                'id' => $id
            )
        );
        return $this->find('first', $options);
    }

}
