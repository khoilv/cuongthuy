<?php

/**
 * @author LanNT
 * @version 1.00
 * @create 2015/10/15
 */

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Frontend\CustomersModel;
use App\Forms\RegisterForm as registerForm;
use App\Forms\FormValidationException;
use App\Models\AutoGenerate;
use Input;
use Request;
use Session;
use Mail;

class RegisterController extends Controller {

    protected $registerForm;
    protected $customersCls;

    public function __construct(registerForm $registerForm, CustomersModel $customersCls) {
        $this->registerForm = $registerForm;
        $this->customersCls = $customersCls;
    }

    public function register() {
        if (Request::ajax()) {
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
                    $errorMsg = (object) array('email' => 'Email này đã được đăng kí. Vui lòng nhập email khác!');
                    $error = true;
                } else {
                    $insertArray = array(
                        'customer_email' => $data['email'],
                        'customer_password' => $data['password'],
                        'customer_code' => AutoGenerate::generateUniqueCustomersCode(),
                        'customer_name' => $data['username'],
                        'customer_address' => $data['address'],
                        'customer_phone' => $data['phone']
                    );
                    if ($this->customersCls->insert($insertArray)) {
                        Session::put('customer_email', $data['email']);
                        Session::put('customer_name', $data['username']);
                        Session::put('register_flag', true);
                    }
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
