<?php
namespace App\Models;
class Job extends TableBase {

    protected $table = 'job';
    public function __construct()
    {
        parent::__construct();
        $this->setTableName($this->table);
    }
    public function getJobList($orderArray, $limitArray, $whereArr)
    {
        $options = array(
            'fields' => array('*'),
            'conditions' => $whereArr,
            'order' => $orderArray,
            'limit' => $limitArray
        );
        return $this->find('all', $options);
    }
    
    public function getCountResult($arrWhere = array())
    {
        $option = array(
            'fields' => array('count(id) as count'),
            'conditions' => $arrWhere
        );
        $data =  $this->find('all', $option);
        return $data[0]['count'];
    }
    
    public function insertJob($insertArray){
        return $this->insert($insertArray);      
    }
    
    public function updateJobById($updateArray,$whereArray){
         return $this->update($updateArray, $whereArray);
    }
    public function getJobById($id){
        $options = array(
             'conditions' => array('id' => $id)
        );
        return $this->find('first', $options);
    }
    public function getJobIdMax(){
        return $this->getIdMax('id');
    }
}