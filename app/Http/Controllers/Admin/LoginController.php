<?php

/**
 * @author LanNT
 * @version 1.00
 * @create 2015/12/02
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Forms\Admin\LoginForm;
use App\Models\Admin\UserModel;
use App\Forms\FormValidationException;
use Input;
use Session;
use Cache;
use Redirect;

class LoginController extends Controller {

    protected $loginForm;

    public function __construct(LoginForm $loginForm) {
        $this->loginForm = $loginForm;
    }

    public function login() {
        $userModel = new UserModel();
        $username = '';
        $password = '';
        $remember = '';
        if (Cache::has('username')) {
            $username = Cache::get('username');
        }
        if (Cache::has('password')) {
            $password = Cache::get('password');
        }
        if (Cache::has('remember')) {
            $remember = Cache::get('remember');
        }
        if (Input::has('login')) {
            $data = Input::except('_token', 'update');
            try {
                // Validate
                $this->loginForm->validate($data);
            } catch (FormValidationException $e) {
                return Redirect::back()->withInput()->withErrors($e->getErrors());
            }
            $userId = $userModel->checkLogin($data['username'], $data['password']);
            if ($userId == false) {
                $error = 'Thông tin đăng nhập không đúng.Vui lòng nhập lại!';
                return Redirect::back()->withInput()->withErrors(array('msg_error' => $error));
            }
            Session::put('username', $data['username']);
            Session::put('user_id', $userId);
            if (isset($data['remember'])) {
                Cache::add('username', $data['username'], 7200);
                Cache::add('password', $data['password'], 7200);
                Cache::add('remember', $data['remember'], 7200);
            }
            return Redirect::action('Admin\TopController@getIndex');
        }
        return view('Admin/login', [
            'username' => $username,
            'password' => $password,
            'remember' => $remember
        ]);
    }

    public function logout() {
        Session::forget('username');
        Session::forget('user_id');
        return Redirect::action('Admin\LoginController@login');
    }

}
