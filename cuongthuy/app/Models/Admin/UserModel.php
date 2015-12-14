<?php
namespace App\Models\Admin;
use App\Models\TableBase;
class UserModel extends TableBase {

    protected $table = 'users';

    public function __construct() {
        parent::__construct();
        $this->setTableName($this->table);
    }
    
    /**
     * Check user login
     * @param string $user
     * @param string $password
     * @return boolean
     */
    public function checkLogin($username, $password)
    {
        $options = array(
            'fields' => array('id'),
            'conditions' => array(
                'username' => $username,
                'password' => md5($password),
            ),
        );
        $result =  $this->find('first', $options);
        if ($result) {
            return $result['id'];
        }
        return false;
    }

    /**
     * Get user info by id
     * @param int $id
     * @return string
     */
    public function getUserNameById($id)
    {
        $options = array(
            'fields' => array('username'),
            'conditions' => array(
                'id' => $id
            )
        );
        $result =  $this->find('first', $options);
        return $result['customer_name'];
    }
}