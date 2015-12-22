<?php

/**
 * @author LinhNV
 * @version 1.00
 * @create 2015/12/22
 */

namespace App\Models\Admin;

use App\Models\TableBase;
use DB;

class CustomerModel extends TableBase {

    protected $table = 'customers';

    public function countNumberCustomer () {
        $table = DB::table($this->table);
        $table->select('*');
        $count = $table->count();
        
        return $count;
    }
}
