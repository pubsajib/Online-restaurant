<?php
namespace App\controller;
use App\model\OpeningHour;
use App\model\Order;
use App\model\OrderProcessType;
use App\model\Payment;
use App\model\Contact;

/**
 * Created by PhpStorm.
 * User: b16030315
 * Date: 1/10/17
 * Time: 6:24 PM
 */
class OrderController extends BaseController
{
    public function writeOrder(){
        $fileName="order-print.txt";
        $file = BASE_DIR.'/'.$fileName;
        $old_order = file_get_contents($file);
        if($old_order==''){
            $new_order = "#02*2*12008*1;Fish;3.00;2;Apple;6.00;3;Water;2.50;*1.0*0;12.50;4;Tom;Address;15:47 03-08-10;133;5;cod:;008612675678;*Comment#
";
            //file_put_contents($file, $new_order);
            $myfile = fopen($file, "w") or die("Unable to open file!");
            fwrite($myfile,$new_order);
            //echo "Order empty </br>";
            echo $new_order;
        }
        else{
            echo "Order exists";
        }
    }

    public function orderCallback(){
        $sUserAgent="";
        $useraccount="";
        $userpwd="";
        $resId="";
        $orderId="";
        $orderStatus="";
        $orderReason="";
        $orderTime="";
        $defaultResId=PRINTER_RES_ID;
        $defaultcount=PRINTER_USERNAME;
        $defaultpwd=PRINTER_PASSWORD;

        if(isset($_SERVER["HTTP_USER-AGENT"])){
            $sUserAgent=$_SERVER["HTTP_USER-AGENT"];
        }
        if(isset($_GET['u'])){
            $useraccount=strtolower($_GET['u']);
        }
        if(isset($_GET['p'])){
            $userpwd=strtolower($_GET['p']);
        }
        if(isset($_GET['a'])){
            $resId=$_GET['a'];
        }
        if(isset($_GET['o'])){
            $orderId=$_GET['o'];
        }
        if(isset($_GET['ak'])){
            $orderStatus=$_GET['ak'];
        }
        if(isset($_GET['m'])){
            $orderReason=$_GET['m'];
        }
        if(isset($_GET['dt'])){
            $orderTime=$_GET['dt'];
        }

        if(($useraccount==$defaultcount)&&($userpwd==$defaultpwd)&&($resId==$defaultResId)) {
            /*if($orderStatus=='Accepted'){
            }
            else if($orderStatus=='Rejected'){
            }*/
            $fileName="order-print.txt";
            $file = BASE_DIR.'/'.$fileName;
            $fp = fopen($file, "r+");
            flock($fp,LOCK_UN);  //unlock file

            // update this order's status to either accepted or rejected.
            $orderModel = new Order();
            $where = ['order_id' => $orderId];
            $orderData = array(
                'order_status' => $orderStatus,
                'status_reason' => $orderReason,
                'printer_delivery_time' => $orderTime
            );
            $returnData = $orderModel->update($orderData, $where);

            if ($returnData['status'] == 200) {
                echo json_encode(['status' => 200, 'message' => 'Order status changed', 'setting_data' => '']);
            } else {
                echo json_encode(['status' => 500, 'message' => $returnData['message']]);
            }

            /*if($orderStatus=='Accepted'){
            }
            else if($orderStatus=='Rejected'){
            }*/

            // send email to customer and admin in same format
        }
        else{
            print substr("",0,1);
        }
    }

    /*private function WriteByBinary($isRange,$filename,$iStart,$iEnd)
    {
        //echo "directory".BASE_DIR; exit();
        extract($GLOBALS);

        $FilePath=BASE_DIR.'/'.$filename;

        if (!file_exists($FilePath)) {
            return 0;
        }
        $fp = fopen($FilePath,'rb');
        if (!$fp) {
            return 0;
        }
        $fileLength = filesize($FilePath);
        $sStr1 = "";
        if (($isRange>0))
        {

            header("Content-type: "."application/octet-stream");
            if ($toBytes>=$fileLength)
            {
                if($fileLength>1){
                    $toBytes=$fileLength-1;
                }
                else{
                    $toBytes=1;
                }

            }


            if (($startBytes>$fileLength))
            {

                $startBytes=$toBytes;
                header("HTTP/1.1 416 Request Range Not Satisfialbe");
                $sStr1="";
                print substr($sStr1,$startBytes+1-1,$toBytes+1-$startBytes);

            }
            else
            {
                ob_end_clean(); //added to fix ZIP file corruption
                ob_start(); //added to fix ZIP file corruption

                fseek($fp, $startBytes);
                $contentRange="bytes ".($startBytes)."-".($toBytes)."/".($fileLength);
                header("Content-Range".": ".$contentRange);
                $rangesize = ($toBytes+1 - $startBytes) > 0 ? ($toBytes+1 - $startBytes) : 0;
                $sStr1 = fread($fp, $rangesize);
                header("Content-Length:" .$rangesize);

                echo $sStr1;
                ob_flush();
                flush();

            }

        }
        else
        {

            $startBytes=0;
            $toBytes=$fileLength;
            $sStr1 = fread($fp, $fileLength);
            print substr($sStr1,$startBytes+1-1,$toBytes+1-$startBytes);
        }


        fclose($fp);

        return 1;
    }*/

    public function orderHistory(){
        $data = array();
        $order_processes = array();
        $pagination = array();
        $rec_limit = 10;
        $date_invalid_message = '';

        if (!$this->isCustomerLoggedIn()) {
            $data['page'] = 'login';
            $this->redirect('login');
        }

        $customer_id = $_SESSION['customer_id'];

        $order = new Order();
        $sql = "SELECT * FROM `orders` O 
                INNER JOIN `customers` C ON O.customer_id = C.customer_id
                WHERE (O.customer_id=$customer_id) ORDER BY order_id DESC";

        $print_sql = "SELECT * FROM `orders` O 
                INNER JOIN `customers` C ON O.customer_id = C.customer_id
                WHERE (O.customer_id=$customer_id) ORDER BY order_id DESC";

        $total_sql = "SELECT count(*) as total_orders FROM `orders`
                WHERE (customer_id=$customer_id)";

        //following commented code block is for searching through all the fields according to the query string
        /*if(isset($_GET['q']) && !empty($_GET['q'])){
            $search_string = '%' . $_GET['q'] . '%';
            $sql .= " AND (order_id LIKE '$search_string' 
                      OR printer_delivery_time LIKE '$search_string'
                      OR total LIKE '$search_string'
                      OR order_status LIKE '$search_string'
                      )";
        }*/

        if(isset($_GET['start_date']) && !empty($_GET['start_date'])){
            $date = date('Y-m-d H:i:s');

            $start_date = date('Y-m-d 00:00:00', strtotime($_GET['start_date']));
            if($date < $start_date){
                $date_invalid_message = 'Invalid Start Date';
            }

            if(isset($_GET['end_date']) && !empty($_GET['end_date'])){
                $end_date = date('Y-m-d 23:59:59', strtotime($_GET['end_date']));
                if($start_date > $end_date){
                    $date_invalid_message = 'Invalid date range';
                }else{
                    $sql .= " AND (O.created_at BETWEEN '$start_date' AND '$end_date')";
                    $print_sql .= " AND (O.created_at BETWEEN '$start_date' AND '$end_date')";
                    $total_sql .= " AND (created_at BETWEEN '$start_date' AND '$end_date')";
                }
            }else{
                $date_invalid_message = 'Invalid end Date';
            }
        }

        if(isset($_GET['page']) && !empty($_GET['page'])){
            $page = $_GET{'page'} + 1;
            $offset = $rec_limit * $page ;
        }else{
            $page = 0;
            $offset = 0;
        }
        $sql .= " LIMIT $offset, $rec_limit";
        $orders = $order->getRaw($sql);
        $print_orders = $order->getRaw($print_sql);

        $total_orders = $order->getRaw($total_sql, 'single');
        $max_pagination = intval($total_orders->total_orders / 10);

        $order_process_type_model = new OrderProcessType();
        $order_process_type_data = $order_process_type_model->getAll();

        if(isset($order_process_type_data) && !empty($order_process_type_data)){
            foreach ($order_process_type_data as $k=>$v){
                $order_processes[$v->order_process_type_id] = $v->order_process_name;
            }
        }

        if(isset($orders) && !empty($orders)) {
            foreach ($orders as $key => $val) {
                if(array_key_exists($val->order_process_type_id, $order_processes)){
                    $orders[$key]->order_process_type_name = $order_processes[$val->order_process_type_id];
                }else{
                    $orders[$key]->order_process_type_name = '';
                }

                $payment_model = new Payment();
                $payment_id = array('order_id' => $val->order_id);
                $payment_type = $payment_model->getWhere($payment_id, ['payment_type'], 'single');

                $orders[$key]->payment_type = isset($payment_type->payment_type) && !empty($payment_type->payment_type) ? $payment_type->payment_type : '';
            }

            for($i = -2; $i < 3; $i++){
                $to_page = $page - $i;
                if(($to_page >= 0) && ($to_page < $max_pagination)){
                    array_push($pagination, $to_page);
                }
            }
            if(!in_array($page, $pagination) && ($page < $max_pagination)){
                array_push($pagination, $page);
            }
            if(count($pagination) < 3 && $max_pagination > 3){
                $min_value = min($pagination) - 1;
                $max_value = max($pagination) + 1;
                if(($min_value > 0) && ($min_value < $max_pagination)){
                    array_push($pagination, $min_value);
                }elseif($max_value < $max_pagination){
                    array_push($pagination, $max_value);
                }
            }
            asort($pagination);
        }

        if(isset($print_orders) && !empty($print_orders)) {
            foreach ($print_orders as $key => $val) {
                if(array_key_exists($val->order_process_type_id, $order_processes)){
                    $print_orders[$key]->order_process_type_name = $order_processes[$val->order_process_type_id];
                }else{
                    $print_orders[$key]->order_process_type_name = '';
                }

                $payment_model = new Payment();
                $payment_id = array('order_id' => $val->order_id);
                $payment_type = $payment_model->getWhere($payment_id, ['payment_type'], 'single');

                $print_orders[$key]->payment_type = isset($payment_type->payment_type) && !empty($payment_type->payment_type) ? $payment_type->payment_type : '';
            }
        }

        $contactsData = $this->getContactInfo();

        $data['order_history'] = $orders;
        $data['print_order_history'] = $print_orders;
        $data['contacts'] = $contactsData;
        $data['pagination'] = $pagination;
        $data['max_pagination'] = $max_pagination - 1;
        $data['date_invalid_message'] = $date_invalid_message;

        $this->view('customer/order_history', $data);
    }


    public function sendOrderHistoryModelBody(){

        $base_url = DOMAIN.BASE_URL;
        $order_id = $_GET['order_id'];

        $sql = "SELECT O.*, O.flat_house_no as delivery_address, O.city_town as delivery_city_town, O.postcode as delivery_postcode, C.* FROM `orders` O 
                INNER JOIN `customers` C ON O.customer_id = C.customer_id 
                WHERE O.order_id=$order_id";
        $order_model = new Order();
        $order_details_data = $order_model->getRaw($sql, 'single');

        if(empty($order_details_data)){
            return 'error';
        }

        $order_process_type_model = new OrderProcessType();
        $order_process_type_id = array('order_process_type_id' => $order_details_data->order_process_type_id);

        //all dynamic data for email is below
        $order_type = $order_process_type_model->getWhere($order_process_type_id, ['order_process_name'], 'single');

        $dispatch_time = $order_details_data->printer_delivery_time;
        $est_dispatch_explode = explode(' ',$dispatch_time);
        if($est_dispatch_explode[1]=="Minutes"){
            $selectedTime = date('h:i:s A', strtotime($order_details_data->created_at));
            $endTime = strtotime("+".$est_dispatch_explode[0]." minutes", strtotime($selectedTime));
            $estimated_dispatch_time = date('h:i', $endTime);
        }
        else{
            $estimated_dispatch_time = date('h:i A', strtotime($dispatch_time));
        }
        $customer_name = ucfirst($order_details_data->first_name) . ' ' . ucfirst($order_details_data->last_name);

        //address field data formation here//
        $raw_address = array();

        if(isset($order_details_data->flat_house_no) && !empty($order_details_data->flat_house_no)){
            array_push($raw_address, $order_details_data->flat_house_no);
        }
        if(isset($order_details_data->street) && !empty($order_details_data->street)){
            array_push($raw_address, $order_details_data->street);
        }
        if(isset($order_details_data->city_town) && !empty($order_details_data->city_town)){
            array_push($raw_address, $order_details_data->city_town);
        }

        $customer_address = implode(', ', $raw_address);
        $delivery_address = $order_details_data->delivery_address;
        if($order_details_data->delivery_city_town!=''){
            $delivery_address .= ', '.$order_details_data->delivery_city_town;
        }

        $customer_email = $order_details_data->email;
        if($order_details_data->mobile!=''){
            $customer_mobile = $order_details_data->mobile;
        }else{
            $customer_mobile  = $order_details_data->phone;
        }
        $customer_postcode = $order_details_data->postcode;
        $delivery_postcode = $order_details_data->delivery_postcode;

        $payment_model = new Payment();
        $payment_id = array('order_id' => $order_id);
        $payment_type = $payment_model->getWhere($payment_id, ['payment_type'], 'single');

        $payment_type = isset($payment_type->payment_type) && !empty($payment_type->payment_type) ? $payment_type->payment_type : '';

        $quantity_sql = "SELECT * FROM order_details WHERE order_id=$order_id";
        $quantity = $order_model->getRaw($quantity_sql);

        $sub_total = (isset($order_details_data->subtotal) && !empty($order_details_data->subtotal)) ? $order_details_data->subtotal : 0;
        $delivery_charge = (isset($order_details_data->delivery_charge) && !empty($order_details_data->delivery_charge)) ? $order_details_data->delivery_charge : 0;
        $delivery_charge = number_format($delivery_charge, 2, '.', '');
        $card_payment_charge = $order_details_data->card_payment_charge;
        $discount = (isset($order_details_data->discount) && !empty($order_details_data->discount)) ? $order_details_data->discount : 0;
        $total = (isset($order_details_data->total) && !empty($order_details_data->total)) ? $order_details_data->total : 0;

        $notes = $order_details_data->order_instruction;

        $contactModel = new Contact();
        $contacts = $contactModel->getFirst();

        $company_name = $contacts->company_name;

        $raw_company_address_street = json_decode($contacts->contact_address_street);
        $company_address_street = $raw_company_address_street->contact_street;

        $raw_company_address_city = json_decode($contacts->contact_address_city);
        $company_address_city = $raw_company_address_city->contact_city;

        $raw_company_address_email = json_decode($contacts->email);
        $company_address_email = $raw_company_address_email->header_email1;

        $raw_company_address_phone = json_decode($contacts->phone);
        $company_address_phone = $raw_company_address_phone->header_phone1;

        $message = "
            <body style=\"margin: 0;font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif;font-size: 14px;line-height: 1.42857143;color: #333;background-color: #fff;\">
                <div class=\"container\" style=\"padding-right: 15px; padding-left: 15px; margin-right: auto; margin-left: auto; width:80%;\">
                    <p style=\"margin: 20px 0px; background-color: rgb(0, 0, 0); font-weight: bold; padding: 6px 0px 6px 12px; color: rgb(255, 255, 255);\">Order Information</p>
                    <!--first table -->
                    <div style=\"\">
                        <table style=\"border-spacing: 0;border-collapse: collapse !important;background-color: transparent;width: 100%;max-width: 100%;margin-bottom: 20px;border: 1px solid black;padding: 6px 12px;\">
                            <tbody>
                                <tr>
                                    <td width=\"30%\" style=\"line-height: 1.2;vertical-align: top;border-top: 0px none !important;background-color: #fff !important;border: 1px solid black;padding: 6px 12px;\">Order Type:</td>
                                    <td style=\"line-height: 1.2;vertical-align: top;border-top: 0px none !important;background-color: #fff !important;border: 1px solid black;padding: 6px 12px;\">$order_type->order_process_name</td>
                                </tr>
                                <tr style=\"\">
                                    <td width=\"30%\" style=\"line-height: 1.2;vertical-align: top;border-top: 0px none !important;background-color: #fff !important;border: 1px solid black;padding: 6px 12px;\">Estimated Dispatch Time:</td>
                                    <td style=\"line-height: 1.2;vertical-align: top;border-top: 0px none !important;background-color: #fff !important;border: 1px solid black;padding: 6px 12px;\"><span>$estimated_dispatch_time</span></td>
                                </tr>
                                <tr>
                                    <td width=\"30%\" style=\"line-height: 1.2;vertical-align: top;border-top: 0px none !important;background-color: #fff !important;border: 1px solid black;padding: 6px 12px;\">Name:</td>
                                    <td style=\"line-height: 1.2;vertical-align: top;border-top: 0px none !important;background-color: #fff !important;border: 1px solid black;padding: 6px 12px;\">$customer_name</td>
                                </tr>
                                <tr>
                                    <td width=\"30%\" style=\"line-height: 1.2;vertical-align: top;border-top: 0px none !important;background-color: #fff !important;border: 1px solid black;padding: 6px 12px;\">Address:</td>
                                    <td style=\"line-height: 1.2;vertical-align: top;border-top: 0px none !important;background-color: #fff !important;border: 1px solid black;padding: 6px 12px;\">$delivery_address</td>
                                </tr>
                                <tr>
                                    <td width=\"30%\" style=\"line-height: 1.2;vertical-align: top;border-top: 0px none !important;background-color: #fff !important;border: 1px solid black;padding: 6px 12px;\">Email:</td>
                                    <td style=\"line-height: 1.2;vertical-align: top;border-top: 0px none !important;background-color: #fff !important;border: 1px solid black;padding: 6px 12px;\">$customer_email</td>
                                </tr> 
                                <tr>
                                    <td width=\"30 % \" style=\"line - height: 1.2;vertical-align: top;border-top: 0px none !important;background-color: #fff !important;border: 1px solid black;padding: 6px 12px;\">Postcode:</td>
                                    <td style = \"line-height: 1.2;vertical-align: top;border-top: 0px none !important;background-color: #fff !important;border: 1px solid black;padding: 6px 12px;\" > $delivery_postcode</td >
                                </tr >
                                <tr>
                                    <td width=\"30%\" style=\"line-height: 1.2;vertical-align: top;border-top: 0px none !important;background-color: #fff !important;border: 1px solid black;padding: 6px 12px;\">Mobile:</td>
                                    <td style=\"line-height: 1.2;vertical-align: top;border-top: 0px none !important;background-color: #fff !important;border: 1px solid black;padding: 6px 12px;\">$customer_mobile</td>
                                </tr>
                                <tr>
                                    <td width=\"30%\" style=\"line-height: 1.2;vertical-align: top;border-top: 0px none !important;background-color: #fff !important;border: 1px solid black;padding: 6px 12px;\">Pay By</td>
                                    <td style=\"line-height: 1.2;vertical-align: top;border-top: 0px none !important;background-color: #fff !important;border: 1px solid black;padding: 6px 12px;\">$payment_type</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!--second table -->
                    <div style=\"\">
                        <table style=\"border-collapse: collapse;width: 100%;border: 1px solid black;padding: 6px 12px;\">
                            <tr>
                                <th width=\"8%\" style=\"border: 1px solid black;padding: 6px 12px;\">Qty</th>
                                <th style=\"border: 1px solid black;padding: 6px 12px;\">Description</th>
                                <th width=\"15%\" style=\"text-align: right;border: 1px solid black;padding: 6px 12px;\">Price</th>
                            </tr>
                            ";

        if(isset($quantity) && !empty($quantity)){
            foreach ($quantity as $key=>$value){
                $product_detail = $this->getProductDetailFromId($value->product_id);
                if($value->sub_product_id!=0){
                    $sub_product_detail = $this->getSubProductDetailFromId($value->sub_product_id);
                    $item_name = $product_detail->name."(".$sub_product_detail->name.")";
                }
                else{
                    $item_name = $product_detail->name;
                }

                $message .= "<tr>";
                $message .= "<td style=\"text-align: center;border: 1px solid black;padding: 6px 12px;\">$value->quantity</td>";
                $message .= "<td style=\"border: 1px solid black;padding: 6px 12px;\">$item_name</td>";
                $message .= "<td width=\"15%\" style=\"text-align: right;border: 1px solid black;padding: 6px 12px;\">&pound;$value->price</td>";
                $message .= "</tr>";
            }
        }

        $message .= "    
                        </table>
                        <!--Third table -->
                        <div class=\"no-border\">
                            <table class=\"\" style=\"border:0 !important;border-collapse: collapse;width: 100%;border: 1px solid black;padding: 6px 12px;\">
                                <tbody>
                                    <tr>
                                        <td style=\"text-align: right; font-weight: 600;border: 1px solid black;padding: 6px 12px;\">Sub Total:</td>
                                        <td width=\"15%\" style=\"text-align: right; font-weight: 600;border: 1px solid black;padding: 6px 12px;\">&pound;$sub_total</td>
                                    </tr>
                                    <tr>
                                        <td style=\"text-align: right; font-weight: 600;border: 1px solid black;padding: 6px 12px;\">Delivery Charge:</td>
                                        <td width=\"15%\" style=\"text-align: right; font-weight: 600;border: 1px solid black;padding: 6px 12px;\">&pound;$delivery_charge</td>
                                    </tr>
                                    <tr>
                                        <td style=\"text-align: right; font-weight: 600;border: 1px solid black;padding: 6px 12px;\">Card Payment Charge:</td>
                                        <td width=\"15%\" style=\"text-align: right; font-weight: 600;border: 1px solid black;padding: 6px 12px;\">&pound;$card_payment_charge</td>
                                    </tr>
                                    <tr>
                                        <td style=\"text-align: right; font-weight: 600;border: 1px solid black;padding: 6px 12px;\">Discount:</td>
                                        <td width=\"15%\" style=\"text-align: right; font-weight: 600;border: 1px solid black;padding: 6px 12px;\">-&pound;$discount</td>
                                    </tr>
                                    <tr>
                                        <td style=\"text-align: right; font-weight: 600;border: 1px solid black;padding: 6px 12px;\">Total:</td>
                                        <td width=\"15%\" style=\"text-align: right; font-weight: 600;border: 1px solid black;padding: 6px 12px;\">&pound;$total</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!--fourth table -->
                        <div style=\"margin-top: 20px;margin-bottom: 20px;\">
                            <table style=\"border-spacing: 0;border-collapse: collapse !important;background-color: transparent;width: 100%;max-width: 100%;margin-bottom: 20px;border: 1px solid black;padding: 6px 12px;\">
                                <tbody>
                                    <tr>
                                        <td width=\"15%\" style=\"line-height: 1.2;vertical-align: top;border-top: 0px none !important;background-color: #fff !important;border: 1px solid black;padding: 6px 12px;\">Notes:</td>
                                        <td style=\"line-height: 1.2;vertical-align: top;border-top: 0px none !important;background-color: #fff !important;border: 1px solid black;padding: 6px 12px;\">$notes</td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                        <!--Company address -->
                        <div style=\"line-height: 5px;\">
                            <p>$company_name</p>
                            <p>$company_address_street</p>
                            <p>$company_address_city</p>
                            <p>$company_address_email</p>
                            <p>$company_address_phone</p>
                        </div>
                    </div>
                </div>
            </body>
        ";

        die($message);
    }

    public function getProductDetailFromId($product_id){
        $products = array();
        if(!empty($product_id)){
            $sql = "SELECT name,price FROM products WHERE product_id=$product_id";
            $orders = new Order();
            $products = $orders->getRaw($sql, 'single');
        }

        return $products;
    }

    public function getSubProductDetailFromId($sub_product_id){
        $sub_products = array();
        if(!empty($sub_product_id)){
            $sql = "SELECT name,price FROM sub_products WHERE sub_product_id=$sub_product_id";
            $orders = new Order();
            $sub_products = $orders->getRaw($sql, 'single');
        }

        return $sub_products;
    }

    private function getContactInfo()
    {
        $contactModel = new Contact();
        $contacts = $contactModel->getFirst();
        $contactsData = array();

        $emailData = json_decode($contacts->email,true);
        $contactsData = array_merge($contactsData, $emailData);

        $streetData = json_decode($contacts->contact_address_street,true);
        $contactsData = array_merge($contactsData, $streetData);

        $cityData = json_decode($contacts->contact_address_city,true);
        $contactsData = array_merge($contactsData, $cityData);

        $postcodeData = json_decode($contacts->contact_address_postcode,true);
        $contactsData = array_merge($contactsData, $postcodeData);

        $phoneData = json_decode($contacts->phone,true);
        $contactsData = array_merge($contactsData, $phoneData);

        $openingHourModel = new OpeningHour();
        $openingHours = $openingHourModel->getFirst();
        $contactsData['opening_times'] = $this->formatOpeningHours($openingHours);
        $currentDay = date("l");
        $currentDay = strtolower($currentDay);
        $contactsData['current_opening_time'] = json_decode($openingHours->{$currentDay},true);

        return $contactsData;
    }

    private function formatOpeningHours($openingHours)
    {
        $opening_hours = array();
        foreach($openingHours as $Key=>$value){
            $opening_hours[$Key] = json_decode($value,true);
        }
        return $opening_hours;
    }

    /*#################################### Order report area ################################*/

    public function orderReport(){
        $data = array();
        $order_processes = array();
        $pagination = array();
        $rec_limit = 10;
        $date_invalid_message = '';

        $order = new Order();
        $sql = "SELECT O.*, O.flat_house_no as delivery_address, O.city_town as delivery_city_town, O.postcode as delivery_postcode, C.* FROM `orders` O 
                INNER JOIN `customers` C ON O.customer_id = C.customer_id
                WHERE (O.order_id !=0)";

        $print_sql = "SELECT O.*, O.flat_house_no as delivery_address, O.city_town as delivery_city_town, O.postcode as delivery_postcode, C.* FROM `orders` O 
                INNER JOIN `customers` C ON O.customer_id = C.customer_id
                WHERE (O.order_id !=0)";

        $total_sql = "SELECT count(*) as total_orders FROM `orders`
                        WHERE (`orders`.order_id !=0)" ;

        if(isset($_GET['start_date']) && !empty($_GET['start_date'])){
            $date = date('Y-m-d H:i:s');

            $start_date = date('Y-m-d 00:00:00', strtotime($_GET['start_date']));
            if($date < $start_date){
                $date_invalid_message = 'Invalid Start Date';
            }

            if(isset($_GET['end_date']) && !empty($_GET['end_date'])){
                $end_date = date('Y-m-d 23:59:59', strtotime($_GET['end_date']));
                if($start_date > $end_date){
                    $date_invalid_message = 'Invalid date range';
                }else{
                    $sql .= " AND (O.created_at BETWEEN '$start_date' AND '$end_date')";
                    $print_sql .= " AND (O.created_at BETWEEN '$start_date' AND '$end_date')";
                    $total_sql .= " AND (created_at BETWEEN '$start_date' AND '$end_date')";
                }
            }else{
                $date_invalid_message = 'Invalid end Date';
            }
        }

        if(isset($_GET['email']) && !empty($_GET['email'])){
            $email = $_GET['email'];
            $sql .= " AND (C.email = '$email')";
            $print_sql .= " AND (C.email = '$email')";
            $total_sql .= " AND (C.email = '$email')";
        }

        if(isset($_GET['mobile']) && !empty($_GET['mobile'])){
            $phone = $_GET['mobile'];
            $sql .= " AND (C.mobile = '$phone')";
            $print_sql .= " AND (C.mobile = '$phone')";
            $total_sql .= " AND (C.mobile = '$phone')";
        }

        if(isset($_GET['order_id']) && !empty($_GET['order_id'])){
            $order_id = $_GET['order_id'];
            $sql .= " AND (O.order_id = '$order_id')";
            $print_sql .= " AND (O.order_id = '$order_id')";
            $total_sql .= " AND (O.order_id = '$order_id')";
        }

        if(isset($_GET['page']) && !empty($_GET['page'])){
            $page = $_GET{'page'} + 1;
            $offset = $rec_limit * $page ;
        }else{
            $page = 0;
            $offset = 0;
        }
        $sql .= " ORDER BY order_id DESC LIMIT $offset, $rec_limit";
        $print_sql .= " ORDER BY order_id DESC LIMIT $offset, $rec_limit";

        $orders = $order->getRaw($sql);
        $print_orders = $order->getRaw($print_sql);

        $total_orders = $order->getRaw($total_sql, 'single');
        $max_pagination = intval($total_orders->total_orders / 10);

        $order_process_type_model = new OrderProcessType();
        $order_process_type_data = $order_process_type_model->getAll();

        if(isset($order_process_type_data) && !empty($order_process_type_data)){
            foreach ($order_process_type_data as $k=>$v){
                $order_processes[$v->order_process_type_id] = $v->order_process_name;
            }
        }

        if(isset($orders) && !empty($orders)) {
            foreach ($orders as $key => $val) {
                if(array_key_exists($val->order_process_type_id, $order_processes)){
                    $orders[$key]->order_process_type_name = $order_processes[$val->order_process_type_id];
                }else{
                    $orders[$key]->order_process_type_name = '';
                }

                $payment_model = new Payment();
                $payment_id = array('order_id' => $val->order_id);
                $payment_type = $payment_model->getWhere($payment_id, ['payment_type'], 'single');

                $orders[$key]->payment_type = isset($payment_type->payment_type) && !empty($payment_type->payment_type) ? $payment_type->payment_type : '';
            }

            for($i = -2; $i < 3; $i++){
                $to_page = $page - $i;
                if(($to_page >= 0) && ($to_page < $max_pagination)){
                    array_push($pagination, $to_page);
                }
            }
            if(!in_array($page, $pagination) && ($page < $max_pagination)){
                array_push($pagination, $page);
            }
            if(count($pagination) < 3 && $max_pagination > 3){
                $min_value = min($pagination) - 1;
                $max_value = max($pagination) + 1;
                if(($min_value > 0) && ($min_value < $max_pagination)){
                    array_push($pagination, $min_value);
                }elseif($max_value < $max_pagination){
                    array_push($pagination, $max_value);
                }
            }
            asort($pagination);
        }

        if(isset($print_orders) && !empty($print_orders)) {
            foreach ($print_orders as $key => $val) {
                if(array_key_exists($val->order_process_type_id, $order_processes)){
                    $print_orders[$key]->order_process_type_name = $order_processes[$val->order_process_type_id];
                }else{
                    $print_orders[$key]->order_process_type_name = '';
                }

                $payment_model = new Payment();
                $payment_id = array('order_id' => $val->order_id);
                $payment_type = $payment_model->getWhere($payment_id, ['payment_type'], 'single');

                $print_orders[$key]->payment_type = isset($payment_type->payment_type) && !empty($payment_type->payment_type) ? $payment_type->payment_type : '';
            }
        }

        $contactsData = $this->getContactInfo();

        $data['order_history'] = $orders;
        $data['print_order_history'] = $print_orders;
        $data['contacts'] = $contactsData;
        $data['pagination'] = $pagination;
        $data['max_pagination'] = $max_pagination - 1;
        $data['date_invalid_message'] = $date_invalid_message;

        $this->view('admin/order_report', $data);
    }

    /*#################################### End of Order report area ################################*/

}
