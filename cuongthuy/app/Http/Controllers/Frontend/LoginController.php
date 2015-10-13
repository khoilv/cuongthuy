<?php namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Models\Frontend\CustomersModel;
use App\Forms\LoginForm;
use App\Forms\FormValidationException;
use Input;
use Request;
use Session;
use Cache;
class LoginController extends Controller {
    protected $loginForm;
    protected $customersCls;
    
    public function __construct(LoginForm $loginForm,CustomersModel $customersCls)
    {
        $this->loginForm = $loginForm;
        $this->customersCls = $customersCls;
    }

     public function login(Request $request, $provider = null){
        if(Request::ajax()) {
            $data = Input::all();
            $error = false;
            $errorMsg = '';
            try {
                // Validate
                $this->loginForm->validate($data);
            } catch (FormValidationException $e) {
                $error = true;
                $errorMsg = $e->getErrors();
            }
            if (!$error) {
                if ($this->customersCls->checkLogin($data['email'], $data['password']) == false) {
                    $errorMsg = (object)array('error_login' => 'Login information is not correct,please try again!');
                    $error = true;
                } else {
                    $customersId = $this->customersCls->checkLogin($data['email'], $data['password']);
                    Session::put('user_login', $customersId);
                    $customerName = $this->customersCls->getUserNameById($customersId);
                    Session::put('user_name', $customerName);
                    if (isset($data['lg_remember'])) {
                        Cache::add('email', $data['email'], 60);
                        Cache::add('password', $data['password'], 60);
                        Cache::add('remember', $data['lg_remember'], 60);
                    }
                }
            }
            $result = array(
                "error" => $error,
                "error_msg" => $errorMsg,
            );
            return (json_encode($result));
        }
        return $this->customersCls->execute($request::all(), $this, $provider);
     }
     public function logout(){
         if(Request::ajax()) {
            Session::forget('user_name');
         }
     }
}