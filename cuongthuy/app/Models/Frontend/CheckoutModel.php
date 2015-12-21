<?php
/**
 * @author LinhNV
 * @version 1.00
 * @create 2015/10/21
 */
namespace App\Models\Frontend;
use App\Models\AutoGenerate;
use DB;
use Session;
use Mail;
class CheckoutModel {
    
    protected $billing;
    protected $shipping;
    protected $productBuy;
    protected $customerId;
    protected $orderCode;

    public function __construct() {
        $this->billing = Session::get('billing');
        $this->shipping = Session::get('shipping');
        $this->productBuy = Session::get('buy');
        $this->orderCode = AutoGenerate::generateUniqueOrdersCode();
        
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
            'order_code'            => $this->orderCode,
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
        foreach ($this->productBuy as $key => $value) {
            $unitPrice = DB::table('products')->where('id', $key)->pluck('product_price');
            $arrOrder[] = [
                'order_id'      => $lastOrderId,
                'product_id'    => $key,
                'unitPrice'     => $unitPrice,
                'quantity'      => $value
            ];
        }
        DB::table('orderdetail')->insert($arrOrder);
        if ($this->billing['email']) {
            $this->sendMail();
        }
    }
    
    public function sendMail () {
        $totalOrderPrice = 0;
        $products = DB::table('products')->whereIn('id', array_keys($this->productBuy))->get();
        foreach ($products as $product) {
            $totalOrderPrice += $product['product_price'] * $this->productBuy[$product['id']];
        }
        Mail::send('Frontend.email.order', [
                'billing'         => $this->billing,
                'shipping'        => $this->shipping,
                'products'        => $products,
                'orderCode'       => $this->orderCode,
                'productBuy'      => $this->productBuy,
                'totalOrderPrice' => $totalOrderPrice
            ],
            function($message) {
                $message->from('admin@cuongthuy.vn', $name = 'Mỹ Phẩm Cường Thủy');
                $message->to($this->billing['email'])->subject('Tiếp nhận đơn hàng');
            }
        );
    }
    
}