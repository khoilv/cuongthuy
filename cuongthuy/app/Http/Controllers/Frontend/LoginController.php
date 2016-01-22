<?php

/**
 * @author LanNT
 * @version 1.00
 * @create 2015/10/15
 */

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Frontend\CustomersModel;
use App\Forms\LoginForm;
use App\Forms\FormValidationException;
use Laravel\Socialite\Contracts\Factory as Socialite;
use Input;
use Request;
use Session;
use Cache;
use Mail;

class LoginController extends Controller {

    protected $loginForm;
    protected $customersCls;
    private $socialite;

    public function __construct(LoginForm $loginForm, CustomersModel $customersCls, Socialite $socialite) {
        $this->loginForm = $loginForm;
        $this->customersCls = $customersCls;
        $this->socialite = $socialite;
    }

    /**
     * Login
     */
    public function login(Request $request, $provider = null) {
        if (Request::ajax()) {
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
                    $errorMsg = (object) array('error_login' => 'Thông tin đăng nhập không đúng.Vui lòng nhập lại!');
                    $error = true;
                } else {
                    $customersId = $this->customersCls->checkLogin($data['email'], $data['password']);
                    Session::put('user_login', $customersId);
                    $customerName = $this->customersCls->getUserNameById($customersId);
                    Session::put('customer_email', $data['email']);
                    Session::put('customer_name', $customerName);
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
        // login with facebook or google
        return $this->execute($request::all(), $provider);
    }

    /**
     * Execute login
     * @param  $request
     * @param string $provider
     * @return type
     */
    public function execute($request, $provider) {
        if (!$request)
            return $this->getAuthorizationFirst($provider);
        $this->customersCls->findByUserNameOrCreate($this->getSocialUser($provider));
        return redirect('/');
    }

    /**
     * Redirect the user to the Facebook/Google authentication page
     * @param string $provider
     * @return Response
     */
    private function getAuthorizationFirst($provider) {
        return $this->socialite->driver($provider)->redirect();
    }

    /**
     * Obtain the user information from Facebook/Google
     * @param string $provider
     * @return Response
     */
    private function getSocialUser($provider) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_CAINFO, "D:\xampp\php\ext\cacert.pem");
        return $this->socialite->driver($provider)->user();
    }

    /**
     * Logout
     */
    public function logout() {
        if (Request::ajax()) {
            Session::forget('customer_name');
            Session::forget('customer_email');
        }
    }

    public function recoverPass() {
        if (Request::ajax()) {
            $data = Input::all();
            $errorMail = '';
            try {
                // Validate
                $this->loginForm->validate($data);
            } catch (FormValidationException $e) {
                $error = json_decode($e->getErrors());
                if (isset($error->email)) {
                    $errorMail = $error->email;
                }
            }
            if (!$errorMail) {
                $user = $this->customersCls->getUserByEmail($data['email']);
                if (!$user) {
                    $errorMail = 'Email chưa được đăng kí!';
                } else {
                    Mail::send('Frontend.email.recover_pass', ['pass' => $user['customer_password'], 'user_name' => $user['customer_name']], function($message) use ($user) {
                        $message->to($user['customer_email'], $user['customer_name'])->subject('Cường thuỷ - Lấy lại mật khẩu!');
                    });
                }
            }
            $result = array(
                "error_email" => $errorMail
            );
            return (json_encode($result));
        }
    }

}
