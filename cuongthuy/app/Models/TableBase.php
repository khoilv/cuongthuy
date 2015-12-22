<?php
namespace App\Models;
use DB;
use PDO;
class TableBase extends DBCommon {

    private $_tableName = '';
    public function __construct()
    {
        DB::connection()->setFetchMode(PDO::FETCH_ASSOC);
    }

    public function getTableName()
    {
        return $this->_tableName;
    }

    public function setTableName($tableName)
    {
        $this->_tableName = $tableName;
    }   

    public function exeBeginTrans()
    {
        DB::beginTransaction();
    }

    public function exeRollBack()
    {
        DB::rollback();
    }

    public function exeCommit()
    {
        DB::commit();
    }
    /**
     *
     * @return mix return first record
     */
    public function getFirstResult($data)
    {
        if (empty($data)) {
            return false;
        }
        return $data[0];
    }
    
    /*
     * Insert data
     * $param array $inserrtArray 
     */
    public function insert($insertArray)
    {
        $insertStmtArray = $this->makeInsertStr($insertArray);
        $sql = 'INSERT INTO ' . $this->getTableName()
                . ' (' . $insertStmtArray['insertColStr'] . ') '
                . 'VALUES (' . $insertStmtArray['insertDataStr'] . ')';
        return DB::insert($sql, $insertStmtArray['insertValue']);
    }
    
    /*
     * Update data
     * $param array $updateArray(key => value)
     * $param array $whereArray(key => value)
     */

    public function update($updateArray, $whereArray)
    {
        $updateStr = $this->makeUpdateStr($updateArray);
        $whereStr = $this->makeWhereStr($whereArray);
        $updateParams = array_values($updateArray);
        $whereParams = array_values($whereArray);
        $bindArray = array();
        foreach ($updateParams as $val) {
            $bindArray[] = $val;
        }
        foreach ($whereParams as $val) {
            $bindArray[] = $val;
        }
        $sql = 'UPDATE ' . $this->getTableName()
                . ' SET ' . $updateStr
                . $whereStr;
        
        return DB::update($sql,$bindArray);
    }
    
     /**
     * Find records statisfy input params
     * @param string $type all|first|scalar format of result
     * @param array $options
     * fields: list of field need to be returned
     * conditions: conditions will be used to build WHERE clause in query
     * joins: list of join tables with type and condition of join
     * group: list of fields will be used to group result
     * order: list of fields and type will be used to sort result
     * @return mixed depend on param $type
     */
    public function find($type = 'all', $options = array()) {

        $fieldsClause = '*';
        if (isset($options['fields'])) {
            $fieldsClause = $this->makeFieldsClause($options['fields']);
        }

        $joinsClause = '';
        if (isset($options['joins'])) {
            $joinsClause = $this->makeJoinClause($options['joins']);
        }

        $params = array();
        $whereClause = '';
        if (isset($options['conditions'])) {
            $whereClause = $this->makeWhereClause($options['conditions'], $params);
        }
        $havingClause = '';
        if (isset($options['having'])) {
            $havingClause = $this->makeHavingClause($options['having'], $params);
        }
        $orderClause = '';
        if (isset($options['order'])) {
            $orderClause = $this->makeOrderClause($options['order']);
        }

        $groupClause = '';
        if (isset($options['group'])) {
            $groupClause = $this->makeGroupClause($options['group']);
        }
        $limitClause = '';
        if (isset($options['limit'])) {
            $limitClause = $this->makeLimitClause($options['limit']);
        }
        $sql = "SELECT $fieldsClause
                FROM {$this->getTableName()} $joinsClause
                $whereClause
                $groupClause
                $havingClause
                $orderClause
                $limitClause";
        $data = DB::select($sql,$params);
        if ($data) {
            if ($type == 'all') {
                return $data;
            } elseif ($type == 'first') {
                return $this->getFirstResult($data);
            }
        }
        return array();
    }
    
    public function getIdMax($id){
         return DB::table($this->getTableName())->max($id);
    }
    public function delete($whereArray){
        $whereStr = $this->makeWhereStr($whereArray);
        $whereParams = array_values($whereArray);
        $bindArray = array();
        foreach ($whereParams as $val) {
            $bindArray[] = $val;
        }
        $sql = 'DELETE FROM ' . $this->getTableName() . $whereStr;
        return  DB::delete($sql,$bindArray);
    }
}

