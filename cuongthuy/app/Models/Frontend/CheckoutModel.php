<?php
namespace App\Models\Frontend;
use DB;
use Session;

class CheckoutModel {
    
    protected $billing;
    protected $shipping;
    protected $cart;
    protected $customerId;

    public function __construct() {
        $this->billing = Session::get('billing');
        $this->shipping = Session::get('shipping');
        $this->cart = Session::get('cart');
        
        if (Session::get('customer_email')) {
            $this->customerId = DB::table('customers')->where('customer_email', Session::get('customer_email'))->pluck('id');
        }
    }
    
    public function InsertOrder() {
        $shipAddres = str_replace(";",",",$this->billing['street']).";".str_replace(";",",",$this->billing['ward'])
                .";".str_replace(";",",",$this->billing['district']);
        
        //Insert order table
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $lastOrderId = DB::table('orders')->insertGetId([
            'customer_id'           => $this->customerId ? $this->customerId : '',
            'order_code'            => '',
            'order_date'            => date("Y-m-d H:i:s"),
            'order_email'           => $this->billing['email'],
            'order_phone'           => $this->billing['telephone'],
            'order_customer_name'   => $this->billing['name'],
            'order_status'          => 1,
            'order_ship_city'       => $this->billing['city'],
            'order_ship_address'    => $shipAddres,
            'order_note'            => $this->billing['note'],
            'payment_method'        => $this->shipping['shipMethod']
            ]);
        
        //Insert order detail table
        $this->InsertOrderDetail($lastOrderId);
        
        return $lastOrderId;
    }
    
    public function InsertOrderDetail ($lastOrderId) {
        foreach ($this->cart as $key => $value) {
            $arrOrder[] = [
                'order_id'      => $lastOrderId,
                'product_id'    => $key,
                'unitPrice'     => 120,
                'quantity'      => $value
            ];
        }
        DB::table('orderdetail')->insert($arrOrder);
    }
}