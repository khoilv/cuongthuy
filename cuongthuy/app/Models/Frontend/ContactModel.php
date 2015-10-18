<?php
namespace App\Models\Frontend;
use App\Models\TableBase;
class ContactModel extends TableBase {

    protected $table = 'contact';

    public function __construct() {
        parent::__construct();
        $this->setTableName($this->table);
    }
}