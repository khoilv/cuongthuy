<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\UserModel;
use App\Forms\Admin\changePasswordForm;
use App\Forms\FormValidationException;
use Request;
use Session;
use Redirect;


class UserController extends Controller {
    
    private $model;
    
    protected $passForm;
    
    public function __construct(changePasswordForm $passForm) {
        $this->passForm = $passForm;
        $this->model = new UserModel();
    }
    
    public function changePassword() {
        if (Request::isMethod('post')) {
            $data = Request::except('_token');
            
            try {
                $this->passForm->validate($data);
            } catch (FormValidationException $e) {
                Session::flash('msg_error', 'Đã xảy ra lỗi.Vui lòng kiểm tra các mục bên dưới');
                return Redirect::back()->withInput()->withErrors($e->getErrors());
            }
            $user = $this->model->getUserByUsername('admin');
            
            if (md5($data['old_password']) != $user['password']) {
                Session::flash('msg_error', 'Mật khẩu cũ không đúng. Vui lòng nhập lại.');
                return Redirect::back()->withInput();
            }
            
            if ($data['new_password'] != $data['new_password_again']) {
                Session::flash('msg_error', 'Mật khẩu mới không trùng nhau. Vui lòng nhập lại.');
                return Redirect::back()->withInput();
            }
            
            if ($this->model->updatePassword ('admin', md5($data['new_password']))) {
                Session::flash('success', 'Cập nhật mật khẩu thành công!');
            }
        }
        return view('Admin/change_pass');
    }

}
