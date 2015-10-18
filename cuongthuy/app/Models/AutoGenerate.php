<?php
/**
 * @author LanNT
 * @version 1.00
 * @create 2015/10/15
 */
namespace App\Models;
use App\Models\Frontend\CustomersModel;
class AutoGenerate
{

    /**
     * Generate unique 'ono' + 10 digitals number
     * Probability in duplicate number 0.1 ~ 0.5%
     * @return string
     */
    public static function generateUniqueCustomersCode()
    {
        $customersModel = new CustomersModel();
        $result = 1;
        $customerCode = '';
        while (!empty($result)) {
            $ranNumber = self::generateUniqueDigital();
            if (is_numeric($ranNumber) && isset($ranNumber)) {
                $customerCode = 'KH' . $ranNumber;
                $result = $customersModel->checkCustomerCode($customerCode);
            }
        }
        return $customerCode;
    }
    
    public static function generateUniqueDigital()
    {
        return substr(number_format(time() * uniqid(rand()), 0, '', ''), 0, 6);
    }
}