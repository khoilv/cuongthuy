<?php
/**
 * @author LanNT
 * @version 1.00
 * @create 2015/10/10
 */
namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Forms\ContactForm;
use App\Forms\FormValidationException;
use App\Models\Frontend\ContactModel;
use Input;
use Request;
use Redirect;
use Session;
class ContactController extends Controller {
    
    protected $contactForm;

    public function __construct(ContactForm $contactForm)
    {
        $this->contactForm = $contactForm;
    }

     public  function getContact(){
         if (Request::isMethod('post')){
            $input = Input::except('_token');
            try {
                // Validate
                $this->contactForm->validate($input);
            } catch (FormValidationException $e) {
                return Redirect::back()->withInput()->withErrors($e->getErrors());
            }
            $contactModel = new ContactModel();
            if ($contactModel->insert($input)){
                Session::flash('success', 'Cảm ơn bạn đã gửi ý kiến đóng góp cho chúng tôi!');
            }
        }
         return view('Frontend.contact');
     }
}