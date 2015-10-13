<?php namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Models\Frontend\CustomersModel;
use App\Forms\RegisterForm as registerForm;
use App\Forms\FormValidationException;
use Input;
use Request;
class RegisterController extends Controller {
    
    protected $registerForm;
    protected $customersCls;
    
    public function __construct(registerForm $registerForm,CustomersModel $customersCls)
    {
        $this->registerForm = $registerForm;
        $this->customersCls = $customersCls;
    }

     public function register(){
        if(Request::ajax()) {
            $data = Input::all();
            $error = false;
            $errorMsg = '';
            try {
                // Validate
                $this->registerForm->validate($data);
            } catch (FormValidationException $e) {
                $error = true;
                $errorMsg = $e->getErrors();
            }
            if (!$error) {
                if ($this->customersCls->getUserByEmail($data['email'])) {
                    $errorMsg = (object)array('email' => 'Email was registered.Please enter different email!');
                    $error = true;
                } else {
                    $insertArray = array(
                        'customer_email' => $data['email'],
                        'customer_password' => $data['password'],
                        'customer_code' => 'KH12345',
                        'customer_name' => $data['username'],
                        'customer_address' => $data['address'],
                        'customer_phone'  => $data['phone']
                    );
                    $this->customersCls->insert($insertArray);
                }
            }
            $result = array(
                "error" => $error,
                "error_msg" => $errorMsg,
            );
            return (json_encode($result));
        }
     }
}