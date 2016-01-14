<?php
/**
 * @author LinhNV
 * @version 1.00
 * @create 2016/01/14
 */
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Input;
use Request;

class ChatController extends Controller {
    
    private $strFileName;
    private $strFileExt;
    private $strFilePath;
    
    public function __construct() {
        $this->strFileName = "Huong dan su dung";
        $this->strFileExt = ".xlsx";
        $this->strFilePath = "public/documents/huongdansudung.xlsx";
    }
    
    public function index () {
        if (!file_exists($this->strFilePath)) {
            header("HTTP/1.0 404 Not Found");
            exit;
        }
        if (Request::isMethod('post')) {
            $strFilePath = Input::get('strFilePath');
            $this->strFileName .= $this->strFileExt;
            $strFileName  = mb_convert_encoding($this->strFileName, "sjis-win", "UTF-8");
            $intLen = filesize($strFilePath);
            header("Cache-Control: public");
            header("Pragma: public");
            header("Content-Disposition: attachment; filename={$strFileName}") ;
            header("Content-Type: application/download; name={$strFileName}");
            header("Content-Length: {$intLen}");
            print file_get_contents($strFilePath, FILE_BINARY);
            exit;
        }
        return view('Admin.chat', [
            'strFileName'   =>  $this->strFileName,
            'strFileExt'    =>  $this->strFileExt,
            'strFilePath'   =>  $this->strFilePath,
            ]);
    }
    
}
