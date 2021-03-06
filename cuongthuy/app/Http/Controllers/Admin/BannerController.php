<?php

/**
 * @author LanNT
 * @version 1.00
 * @create 2015/12/05
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\BannerModel;
use App\Forms\Admin\BannerForm;
use App\Forms\FormValidationException;
use Request;
use Redirect;
use Session;

class BannerController extends Controller {

    private $bannerCls;
    protected $bannerForm;

    public function __construct(BannerForm $bannerForm) {
        $this->bannerCls = new BannerModel();
        $this->bannerForm = $bannerForm;
    }

    public function index() {
        return view('Admin/banner/index');
    }

    public function detail($id = '') {
        $banner = array();
        $arrBannerStatus = array(
            1 => 'Đang hoạt động',
            2 => 'Kết thúc'
        );
        if ($id) {
            $banner = $this->bannerCls->getBannerById($id);
        }
        if (Request::isMethod('post')) {
            $input = Request::except('_token');
            try {
                // Validate
                $this->bannerForm->validate($input);
            } catch (FormValidationException $e) {
                Session::flash('msg_error', 'Đã xảy ra lỗi.Vui lòng kiểm tra các mục bên dưới');
                return Redirect::back()->withInput()->withErrors($e->getErrors());
            }
            $destinationPath = 'public/images/upload/banner';
            if ($id) {
                if (isset($input['banner_image_path'])) {
                    $error = $this->checkSizeImage($_FILES['banner_image_path']['tmp_name']);
                    if ($error) {
                        return Redirect::back()->withInput()->withErrors($error);
                    }
                    // Upload img
                    $extension = $input['banner_image_path']->getClientOriginalExtension(); // getting image extension
                    $filename = 'banner' . $id . '.' . $extension;
                    $input['banner_image_path']->move($destinationPath, $filename);
                    $input['banner_image_path'] = $filename;
                }
                if ($this->bannerCls->update($input, array('id' => $id))) {
                    Session::flash('success', 'Bạn đã cập nhật thành công!');
                    return Redirect::action('Admin\BannerController@detail', $id);
                }
            } else {
                $id = $this->bannerCls->getIdMax('id') + 1;
                $input['banner_date_added'] = date("Y-m-d");
                if (isset($input['banner_image_path'])) {
                    $error = $this->checkSizeImage($_FILES['banner_image_path']['tmp_name']);
                    if ($error) {
                        return Redirect::back()->withInput()->withErrors($error);
                    }
                    // Upload img
                    $extension = $input['banner_image_path']->getClientOriginalExtension(); // getting image extension
                    $filename = 'banner' . $id . '.' . $extension;
                    $input['banner_image_path']->move($destinationPath, $filename);
                    $input['banner_image_path'] = $filename;
                }
                if ($this->bannerCls->insert($input)) {
                    Session::flash('success', 'Bạn đã đăng kí thành công!');
                    return Redirect::action('Admin\BannerController@detail', $id);
                }
            }
        }
        return view('Admin/banner/detail', [
            'banner'            => $banner,
            'arrBannerStatus'   => $arrBannerStatus
        ]);
    }

    public function listBanner() {
        $banners = $this->bannerCls->getBannerList();
        return view('Admin/banner/list', [
            'banners' => $banners
        ]);
    }

    public function checkSizeImage($image) {
        $error = array();
        list($width, $height, $type) = @getimagesize($image);
        if ($width != 1024) {
            $error['banner_image_path'] = 'Kích thước chiều rộng ảnh không đúng';
            return $error;
        }
        if ($height != 289) {
            $error['banner_image_path'] = 'Kích thước chiều dài ảnh không đúng';
            return $error;
        }
        return false;
    }

}
