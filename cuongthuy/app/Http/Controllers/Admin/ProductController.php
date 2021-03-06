<?php

/**
 * @author LanNT
 * @version 1.00
 * @create 2015/12/05
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\ProductModel;
use App\Models\Frontend\CategoryModel;
use App\Forms\Admin\ProductForm;
use App\Forms\FormValidationException;
use Input;
use Request;
use Redirect;
use Session;
use App\Lib\InitialDefine;
use Imagick;
use File;

class ProductController extends Controller {

    private $productCls;
    private $categoryCls;
    protected $productForm;

    public function __construct(ProductForm $productForm) {
        $this->productCls = new ProductModel();
        $this->categoryCls = new CategoryModel();
        $this->productForm = $productForm;
        date_default_timezone_set('Asia/Ho_Chi_Minh');
    }

    public function index() {
        return view('Admin/product/index');
    }

    public function detail($productId = '') {
        $product = array();
        $category = array('' => 'Chọn loại sản phẩm') + $this->categoryCls->getCategoryName();
        $arrProductStatus = InitialDefine::$arrProductStatus;
        $arrProductSellStatus = InitialDefine::$arrProductSellStatus;
        if ($productId) {
            $product = $this->productCls->getProductById($productId);
            $product['product_other_image'] = explode(',', $product['product_other_image']);
        }
        if (Request::isMethod('post')) {
            $input = Input::except('_token');
            try {
                // Validate
                $this->productForm->validate($input);
            } catch (FormValidationException $e) {
                Session::flash('msg_error', 'Đã xảy ra lỗi.Vui lòng kiểm tra các mục bên dưới');
                return Redirect::back()->withInput()->withErrors($e->getErrors());
            }
            if ($productId) {
                return $this->update($input, $product, $productId);
            } else {
                return $this->insert($input);
            }
        }
        return view('Admin/product/detail', [
            'product' => $product,
            'category' => $category,
            'product_id' => $productId,
            'arrProductStatus' => $arrProductStatus,
            'arrProductSellStatus' => $arrProductSellStatus
        ]);
    }

    public function insert($input) {
        $destinationPath = 'public/images/upload/products';
        $input['product_sell_status'] = implode(',', $input['product_sell_status']);
        $product_other_image = '';
        $productId = $this->productCls->getIdMax('id') + 1;
        $i = 0;
        foreach ($input as $key => $val) {
            if ($key == 'product_image') {
                // Upload img
                $extension = $input[$key]->getClientOriginalExtension(); // getting image extension
                $filename = 'product' . $productId . '.' . $extension;
                $this->uploadImage($_FILES[$key]['tmp_name'], $destinationPath . '/' . $filename, 186, 182);
                $input[$key] = $filename;
            }
            if (strpos($key, 'product_other_image') !== false) {
                // Upload img
                $extension = $input[$key]->getClientOriginalExtension(); // getting image extension
                $filename = 'product' . $productId . '_' . $i . '.' . $extension;
                $this->uploadImage($_FILES[$key]['tmp_name'], $destinationPath . '/' . $filename, 492, 300);
                $product_other_image .= $filename . ',';
                $i++;
                unset($input[$key]);
                // update image thumb
                $this->uploadImage($_FILES[$key]['tmp_name'], $destinationPath . '/thumb_' . $filename, 100, 72);
            }
        }
        if ($product_other_image) {
            $input['product_other_image'] = trim($product_other_image, ",");
        }
        $input['product_date_added'] = date("Y-m-d H:i:s");
        $input['product_date_modify'] = date("Y-m-d H:i:s");
        $tmpArr = array("&nbsp;" => " ");
        $input['product_description'] = stripslashes(strtr($input['product_description'], $tmpArr));
        if ($this->productCls->insert($input)) {
            $idMax = $this->productCls->getIdMax('id') + 1;
            Session::flash('success', 'Bạn đã tạo sản phẩm thành công!');
            return Redirect::action('Admin\ProductController@detail', $idMax);
        }
    }

    public function update($input, $product, $productId) {
        $destinationPath = 'public/images/upload/products';
        $input['product_sell_status'] = implode(',', $input['product_sell_status']);
        $product_other_image = '';
        foreach ($input as $key => $val) {
            if ($key == 'product_image') {
                // Upload img
                $extension = $input['product_image']->getClientOriginalExtension(); // getting image extension
                $filename = 'product' . $productId . '.' . $extension;
                $this->uploadImage($_FILES[$key]['tmp_name'], $destinationPath . '/' . $filename, 186, 182);
                $input['product_image'] = $filename;
            }
            if (strpos($key, 'product_other_image') !== false && isset($product['product_other_image'])) {
                $image = explode('_', $key);
                $count = count($product['product_other_image']);
                if ($count == 0) {
                    $i = 0;
                } else if ((int) $image[3] < $count) {
                    $i = (int) $image[3];
                } else {
                    $i = $count;
                }
                // Upload img
                $extension = $input[$key]->getClientOriginalExtension(); // getting image extension
                $filename = 'product' . $productId . '_' . $i . '.' . $extension;
                $this->uploadImage($_FILES[$key]['tmp_name'], $destinationPath . '/' . $filename, 492, 300);
                $product['product_other_image'][$i] = $filename;
                $product_other_image = implode(',', $product['product_other_image']);
                unset($input[$key]);
                // update image thumb
                $this->uploadImage($_FILES[$key]['tmp_name'], $destinationPath . '/thumb_' . $filename, 100, 72);
            }
        }
        if ($product_other_image) {
            $input['product_other_image'] = trim($product_other_image, ",");
        }
        $input['product_date_modify'] = date("Y-m-d H:i:s");
        $tmpArr = array("&nbsp;" => " ");
        $input['product_description'] = stripslashes(strtr($input['product_description'], $tmpArr));
        if ($this->productCls->update($input, array('id' => $productId))) {
            Session::flash('success', 'Bạn đã cập nhật sản phẩm thành công!');
            return Redirect::action('Admin\ProductController@detail', $productId);
        }
    }

    public function delete() {
        $result['error'] = false;
        $product_other_image = array();
        if (Request::ajax()) {
            $data = Input::all();
            $product = $this->productCls->getProductById($data['product_id']);
            $product_other_image = explode(',', $product['product_other_image']);
            foreach ($product_other_image as $key => $val) {
                $filename = public_path() . '/images/upload/products/' . $val;
                $imageThumb = public_path() . '/images/upload/products/thumb_' . $val;
                if (File::exists($filename)) {
                    File::delete($filename);
                }
                if (File::exists($imageThumb)) {
                    File::delete($imageThumb);
                }
                if (File::exists(public_path() . '/images/upload/products/' . $product['product_image'])) {
                    File::delete(public_path() . '/images/upload/products/' . $product['product_image']);
                }
            }
            if (!$this->productCls->delete(array('id' => $data['product_id']))) {
                $result['error'] = true;
            }
            return (json_encode($result));
        }
    }

    public function uploadImage($fileUpload, $filePath, $cropWidth, $cropHeight) {
        $imagick = new Imagick($fileUpload);
        $width = $imagick->getImageWidth();
        $height = $imagick->getImageHeight();
        if ($width > $cropWidth && $height > $cropHeight) {
            if ($cropWidth > $cropHeight) {
                $newWidth = $cropWidth;
                $newHeight = $height / ($width / $cropWidth);
            } else {
                $newWidth = $width / ($height / $cropHeight);
                $newHeight = $cropHeight;
            }
        } else if ($width <= $cropWidth && $height > $cropHeight) {
            $newWidth = $width / ($height / $cropHeight);
            $newHeight = $cropHeight;
        } else if ($width > $cropWidth && $height <= $cropHeight) {
            $newWidth = $cropWidth;
            $newHeight = $height / ($width / $cropWidth);
        } else {
            $newWidth = $width;
            $newHeight = $height;
        }
        $imagick->resizeImage($newWidth, $newHeight, Imagick::FILTER_LANCZOS, 1);
        $imagick->writeImage($filePath);
        @chmod($filePath, 0664);
        $imagick->destroy();
    }

    public function search() {
        $arrProductStatus = array('' => 'Chọn trạng thái') + InitialDefine::$arrProductStatus;
        $category = array('' => 'Chọn loại sản phẩm') + $this->categoryCls->getCategoryName();
        $arrWhere = array();
        $form = array();
        $page = 1;
        $form = Input::except('_token', 'page');
        if (Input::has('product_code')) {
            $arrWhere['product_code LIKE'] = "%" . Input::get('product_code') . "%";
        }
        if (Input::has('product_name')) {
            $arrWhere['product_name LIKE'] = "%" . Input::get('product_name') . "%";
        }
        if (Input::has('product_status')) {
            $arrWhere['product_status'] = Input::get('product_status');
        }
        if (Input::has('product_category')) {
            $arrWhere['product_category'] = Input::get('product_category');
        }
        if (Input::has('page')) {
            $page = Input::get('page');
        }
        $totalRecord = $this->productCls->getCountResult($arrWhere);

        $form['limit'] = isset($form['limit']) ? $form['limit'] : 25;
        $maxRec = $form['limit'];
        $offset = ($page - 1) * $maxRec;
        $lastPage = ceil($totalRecord / $maxRec);
        $currentPage = $page;
        $previousPage = $page > 1 ? $page - 1 : 1;
        $nextPage = $page < $lastPage ? $page + 1 : $lastPage;
        $limitArr = array($offset, $maxRec);
        $arrProductList = $this->productCls->getProductList($arrWhere, $limitArr);
        //download csv
        if (Input::has('cmd') && Input::get('cmd') == 'csv_download') {
            $csvProducts = $this->productCls->getProductList($arrWhere, array());
            $strCSV = '';
            $strCSV .= "Id\tMã sản phẩm\tTên sản phẩm\tLoại sản phẩm\tGiá tiền\tTrạng thái\tSố lượng";
            $strCSV .= "\n";
            foreach ($csvProducts as $line) {
                $line['product_category'] = $category[$line['product_category']];
                $line['product_status'] = $arrProductStatus[$line['product_status']];
                $strCSV .= implode("\t", $line);
                $strCSV.= "\r\n";
            }
            $strCSV = mb_convert_encoding($strCSV, 'UTF-16LE', "UTF-8");
            $filename = 'product_data_' . date('d_m_Y') . '.csv';
            $strFileName = mb_convert_encoding($filename, "UTF-8");
            $intLen = strlen($strCSV);
            header("Cache-Control: public");
            header("Pragma: public");
            header("Content-Disposition: attachment; filename={$strFileName}");
            header("Content-Type: text/csv; charset=UTF-8");
            header("Content-Type: application/download; name={$strFileName}");
            header("Content-Length: {$intLen}");
            echo chr(255) . chr(254) . $strCSV;
            exit;
        }
        return view('Admin.product.search', [
            'arrProductList'    => $arrProductList,
            'category'          => $category,
            'arrProductStatus'  => $arrProductStatus,
            'form'              => $form,
            'currentPage'       => $currentPage,
            'lastPage'          => $lastPage,
            'previousPage'      => $previousPage,
            'nextPage'          => $nextPage,
            'maxRec'            => $maxRec
        ]);
    }

}
