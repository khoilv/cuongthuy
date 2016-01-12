<?php

namespace App\Models\Admin;
use DB;

class ContactDetailModel {
    
    private $table = 'contact';
    
    public function getOrderDetailById($id) {
        $table = DB::table($this->table)
                ->select('*')
                ->where('id', $id)
                ->first();
        return (array)$table;
    }
}

