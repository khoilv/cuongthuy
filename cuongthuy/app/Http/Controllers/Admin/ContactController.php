<?php
/**
 * @author LinhNV
 * @version 1.00
 * @create 2016/01/06
 */
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\ContactModel;
use Input;
use DateTime;

class ContactController extends Controller {
    
    private $model;
    private static $CONTACT_MAX = 25;
    
    public function __construct() {
        $this->model = new ContactModel();
    }
    
    public function index () {
        $input = Input::except('_token');
        
        $page = 1;
        $option = [];
        $option['order'] = ['id' => 'DESC'];
        
        if (Input::has('contact_name')) {
            $option['arrWhereLike'][] = ['contact_name' => $input['contact_name']];
        }
        if (Input::has('contact_phone')) {
            $option['arrWhere'][] = ['contact_phone' => $input['contact_phone']];
        }
        if (Input::has('contact_email')) {
            $option['arrWhere'][] = ['contact_email' => $input['contact_email']];
        }
        if (Input::has('contact_sort')) {
            $option['order'] = ['id' => $input['contact_sort']];
        }
        if (Input::has('contact_date_start')) {
            $option['arrWhereStart'] = ['contact_datetime' => date_format(DateTime::createFromFormat('d/m/Y', $input['contact_date_start']), "Y:m:d")];
        }
        if (Input::has('contact_date_end')) {
            $option['arrWhereEnd'] = ['contact_datetime' => date_format(DateTime::createFromFormat('d/m/Y', $input['contact_date_end']), "Y:m:d")];
        }
        $option['limit'] = $maxRec = self::$CONTACT_MAX;
        if (Input::has('page')) {
            $page = $input['page'];
            $option['offset'] = $option['limit']*($input['page'] - 1);
        }

        $contacts = $this->model->getContactList($option);
        $count = $this->model->getCountContactList($option);
        
        $lastPage = ceil($count / $maxRec);
        $currentPage = $page;
        $previousPage = $page > 1 ? $page - 1 : 1;
        $nextPage = $page < $lastPage ? $page + 1 : $lastPage;
        return view('Admin.contact.index', [
                    'contacts'      => $contacts,
                    'input'         => $input,
                    'lastPage'      => $lastPage,
                    'currentPage'   => $currentPage,
                    'previousPage'  => $previousPage,
                    'nextPage'      => $nextPage,
                    'maxRec'        => $maxRec,
                    'offset'        => isset($option['offset'])?$option['offset']:0
                ]);
    }
    
}
