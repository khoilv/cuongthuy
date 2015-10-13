<?php
namespace App\Models\Frontend;
use App\Models\TableBase;
use Laravel\Socialite\Contracts\Factory as Socialite;
use Session;
class CustomersModel extends TableBase {
    
    private $socialite;
    protected $table = 'customers';

    public function __construct(Socialite $socialite) {
        parent::__construct();
        $this->setTableName($this->table);
        $this->socialite = $socialite;
    }

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
    
    public function execute($request, $listener, $provider) {
       if (!$request) return $this->getAuthorizationFirst($provider);
       $this->findByUserNameOrCreate($this->getSocialUser($provider));
       return redirect('/');
    }

    private function getAuthorizationFirst($provider) {
        return $this->socialite->driver($provider)->redirect();
    }

    private function getSocialUser($provider) {
        $ch = curl_init();
        curl_setopt ($ch, CURLOPT_CAINFO, "D:\xampp\php\ext\cacert.pem");
        return $this->socialite->driver($provider)->user();
    }
    
    public function findByUserNameOrCreate($userData) {
        $user = $this->getUserByEmail($userData->email);
        if(!$user) {
            $user = array(
                'customer_email' => $userData->email,
                'customer_name' => $userData->name,
                'customer_code' => 'KH' . $userData->id
            );
           $this->insert($user);
        }

        $this->checkIfUserNeedsUpdating($userData, $user);
        //Session::put('user_login', $user['id']);
        Session::put('user_name', $userData->name);
    }

    public function checkIfUserNeedsUpdating($userData, $user) {

        $socialData = [
            'customer_email' => $userData->email,
            'customer_name' => $userData->name,
            'customer_code' => 'KH' . $userData->id
        ];
        if (!empty(array_diff($socialData, $user))) {
            $this->update($socialData,array('id'=> $user['id']));
        }
    }
}