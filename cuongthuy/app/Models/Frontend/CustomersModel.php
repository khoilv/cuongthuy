<?php
namespace App\Models\Frontend;
use App\Models\TableBase;
use Session;
use App\Models\AutoGenerate;
class CustomersModel extends TableBase {

    protected $table = 'customers';

    public function __construct() {
        parent::__construct();
        $this->setTableName($this->table);
    }
    
    /**
     * Check user login
     * @param string $email
     * @param string $password
     * @return boolean
     */
    public function checkLogin($email, $password)
    {
        $options = array(
            'fields' => array('id'),
            'conditions' => array(
                'customer_email' => $email,
                'customer_password' => $password,
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
            'fields' => array('customer_name'),
            'conditions' => array(
                'id' => $id
            )
        );
        $result =  $this->find('first', $options);
        return $result['customer_name'];
    }
    
    /**
     * Get user info by email
     * @param string $email
     * @return array
     */
    public function getUserByEmail($email)
    {
        $options = array(
            'fields' => array('*'),
            'conditions' => array(
                'customer_email' => $email
            )
        );
        $result =  $this->find('first', $options);
        return $result;
    }

    /**
     * Check user login, then insert or update info of user
     * @param object $userData
     */
    public function findByUserNameOrCreate($userData) {
        $user = $this->getUserByEmail($userData->email);
        if(!$user) {
            $user = array(
                'customer_email' => $userData->email,
                'customer_name' => $userData->name,
                'customer_code' => AutoGenerate::generateUniqueCustomersCode()
            );
           $this->insert($user);
        }

        $this->checkIfUserNeedsUpdating($userData, $user);
        Session::put('customer_email', $userData->email);
        Session::put('customer_name', $userData->name);
    }

    /**
     * Update user info
     * @param object $userData
     * @param array $user
     */
    public function checkIfUserNeedsUpdating($userData, $user) {

        $socialData = [
            'customer_email' => $userData->email,
            'customer_name' => $userData->name
        ];
        if (!empty(array_diff($socialData, $user))) {
            $this->update($socialData,array('id'=> $user['id']));
        }
    }
    
    public function checkCustomerCode($customerCode){
        $options = array(
            'fields' => array('id'),
            'conditions' => array(
                'customer_code' => $customerCode,
            )
        );
        return $this->find('all', $options);
    }
}