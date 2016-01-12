<?php

/**
 * @author LinhNV
 * @version 1.00
 * @create 2015/12/13
 */

namespace App\Models\Admin;

use DB;

class ContactModel {

    protected $table = 'contact';

    public function __construct() {
        //parent::__construct();
    }
    
    public function getContactList ($option) {
        $table = $this->makeParam($option);
        
        if (!empty ($option['offset'])) {
            $table->skip($option['offset']);
        }
        if (!empty ($option['limit'])) {
            $table->take($option['limit']);
        }
        $result = $table->get();
        return $result;
    }
    
    public function getCountContactList ($option) {
        $table = $this->makeParam($option);
        $count = $table->count();
        return $count;
    }
    
    private function makeParam ($option) {
        $table = DB::table($this->table);
        $table->select('*');
        if (!empty($option['arrWhere']) && is_array($option['arrWhere'])) {
            foreach($option['arrWhere'] as $key => $value) {
                $table->where(array_keys($value)[0],array_values($value)[0]) ;
            }
        }
        if (!empty($option['arrWhereLike']) && is_array($option['arrWhereLike'])) {
            foreach($option['arrWhereLike'] as $key => $value) {
                $table->where(array_keys($value)[0],'like' ,'%'.array_values($value)[0].'%') ;
            }
        }
        if (!empty($option['arrWhereStart']) && is_array($option['arrWhereStart'])) {
            $table->where(array_keys($option['arrWhereStart'])[0], '>' , array_values($option['arrWhereStart'])[0]);
        }
        if (!empty($option['arrWhereEnd']) && is_array($option['arrWhereEnd'])) {
            $table->where(array_keys($option['arrWhereEnd'])[0], '<' , array_values($option['arrWhereEnd'])[0]);
        }
        if (!empty($option['order']) && is_array($option['order'])) {
            $table->orderBy(array_keys($option['order'])[0], array_values($option['order'])[0]);
        }
        return $table;
    }
}
