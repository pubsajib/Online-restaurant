<?php
/**
 * Created by PhpStorm.
 * User: b16030315
 * Date: 1/6/17
 * Time: 3:12 PM
 */
namespace App\controller;
use App\model\Banner;
use App\model\Address;
use App\model\BaseModel;
use App\model\Category;
use App\model\Customer;
use App\model\DeliveryTime;
use App\model\Offer;
use App\model\OpeningHour;
use App\model\Order;
use App\model\OrderDetails;
use App\model\OrderProcessType;
use App\model\PaymentType;
use App\model\Postcode;
use App\model\Product;
use App\model\SubProduct;
use App\model\Settings;
use App\model\Contact;
use App\model\Page;
use App\model\Discount;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use App\model\ProductOffer;
use App\model\ProductExtra;

/**
 * Class CustomerController
 * @package App\controller
 */
class CustomerController extends BaseController
{
    public function index()
    {
        $contactsData = $this->getContactInfo();
        $data['contacts'] = $contactsData;

        $offerModel = new Offer();
        $joinTables = array(
            array(
                'tableName' => 'products',
                'constraintKey' => 'product_id',
            )
        );
        //$data['offers'] = $offerModel->getJoinedData($joinTables, ['is_active' => 'Active']);
        $data['offers'] = $offerModel->getRaw('select *, offer.is_active as offer_active from offer join products on products.product_id = offer.product_id where products.is_active = "True" and offer.is_active = "Active"');
        //echo "<pre>";print_r($data['offers']);echo "</pre>";exit();

        $settingsModel = new Settings();
        $data['bannerData'] = $settingsModel->getFirst();
        $data['page'] = 'index';
        $this->view('customer/index', $data);
        //echo "<pre>"; print_r($contactsData); echo "</pre>";
    }

    public function order()
    {
        $contactsData = $this->getContactInfo();
        $data['contacts'] = $contactsData;
        $data['page'] = 'order';
        $productModel = new Product();
        $categoryModel = new Category();
        $orderProcessTypeModel = new OrderProcessType();
        $data['orderProcessTypes'] = $orderProcessTypeModel->getWhere(['is_active' => 1]);
        $openingHourModel = new OpeningHour();
        $openingHours = $openingHourModel->getFirst();
        $today = strtolower(date('l'));
        $data['openingHour'] = json_decode($openingHours->{$today});
        $settingsModel = new Settings();
        $data['settings'] = $settingsModel->getFirst();
        $offerModel = new Offer();
        $data['offers'] = $offerModel->getRaw('select *, offer.is_active as offer_active from offer join products on products.product_id = offer.product_id where products.is_active = "True" and offer.is_active = "Active"');
        //echo "<pre>";print_r($data['offers']);echo "</pre>";exit();
        $products = $productModel->getRaw("select *  from products join categories on categories.category_id = products.category_id where products.is_active = 'True' order by products.display_order, products.name asc;");
        //$data['categories'] = $categoryModel->getWhere(['is_active' => 'true']);
        $data['categories'] = $categoryModel->getRaw("select *  from categories where categories.is_active = 'True' order by display_order, category_name asc");
        $count = 0;
        $subProductModel = new SubProduct();
        $productOfferModel = new ProductOffer();
        $productExtraModel = new ProductExtra();

        foreach ($data['categories'] as $category) {
            foreach ($products as $product) {
                $sub_products = $subProductModel->getRaw("select *  from sub_products where product_id = $product->product_id order by sub_products.display_order, sub_products.name asc;");
                $product->sub_products = $sub_products;
                if ($product->category_id == $category->category_id) {
                    $category->products[] = $product;
                }
                /*foreach ($offers as $offer) {
                    if ($offer->product_id == $product->product_id) {
                        $category->products[]['category'] = $offer;
                    }
                }*/

                // Geting offered products
                // $product->product_id
                $product->offers = $productOfferModel->getRaw("select *  from product_offer where product_id = $product->product_id and is_active = 'Active' order by offer_id asc;");
                // Geting extra products
                $product->extras = $productExtraModel->getRaw("select *  from product_extra where product_id = $product->product_id and is_active = 'Active' order by extra_id asc;");
                // echo '<pre>'; print_r($data); echo '</pre>'; die();
            }
            $count++;

        }
        //echo "<pre>";print_r($data['categories']);echo "</pre>";exit();
        $this->view('customer/order', $data);
    }

    public function addToCart()
    {
        //unset($_SESSION['cart']);exit();
        //echo "<pre>";print_r($_POST['cart']);echo "</pre>";exit();
        //unset($_SESSION['cart']);
        $productId = $_POST['product_id'];
        $where = ['product_id' => $productId];
        $productModel = new Product();
        $product = $productModel->getWhere($where, [], 'single');

        $productName = explode(' ', $product->name);
        $productName = implode('_', $productName);

        /*if (array_key_exists($productName, $_SESSION['cart']['products'])) {
            if ($_POST['decrement'] == 'true') {
                if ($_SESSION['cart']['products'][$productName]['quantity'] != 0) {
                    $_SESSION['cart']['products'][$productName]['quantity'] = $_SESSION['cart']['products'][$productName]['quantity'] - 1;
                    $_SESSION['cart']['products'][$productName]['price'] = $_SESSION['cart']['products'][$productName]['price'] - $product->price;
                }
            } else {
                $_SESSION['cart']['products'][$productName]['quantity'] = $_SESSION['cart']['products'][$productName]['quantity'] + 1;
                $_SESSION['cart']['products'][$productName]['price'] = $_SESSION['cart']['products'][$productName]['price'] + $product->price;
            }


        } else {
            $_SESSION['cart']['products'][$productName] = array(
                'product_id' => $product->product_id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
            );
        }
        $totalPrice = 0;
        if (!empty($_SESSION['cart']['products'])) {
            $totalPrice = 0;
            foreach ($_SESSION['cart']['products'] as $item) {
                $totalPrice = $totalPrice + $item['price'];
            }
        }

        $_SESSION['cart']['total_price'] = $totalPrice;*/
        $cart = $_POST['cart'];
        if (isset($cart['products']) && array_key_exists($productName, $cart['products'])) {
            if ($_POST['decrement'] == 'true') {
                if ($cart['products'][$productName]['quantity'] != 0) {
                    $cart['products'][$productName]['quantity'] = $cart['products'][$productName]['quantity'] - 1;
                    $cart['products'][$productName]['price'] = $cart['products'][$productName]['price'] - $product->price;
                }
            } else {
                $cart['products'][$productName]['quantity'] = $cart['products'][$productName]['quantity'] + 1;
                $cart['products'][$productName]['price'] = $cart['products'][$productName]['price'] + $product->price;
            }
        } else {
            $cart['products'][$productName] = array(
                'product_id' => $product->product_id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
            );
        }
        $totalPrice = 0;
        if (!empty($cart['products'])) {
            $totalPrice = 0;
            foreach ($cart['products'] as $item) {
                $totalPrice = $totalPrice + $item['price'];
            }
        }

        $cart['total_price'] = $totalPrice;

        //echo "<pre>";print_r($_SESSION['cart']);echo "</pre>";exit();
        echo json_encode(['status' => 200, 'cart' => $cart]);

    }

    public function removeFromCart()
    {
        $productId = $_POST['product_id'];
        $where = ['product_id' => $productId];
        $productModel = new Product();
        $product = $productModel->getWhere($where, [], 'single');

        $productName = explode(' ', $product->name);
        $productName = implode('_', $productName);

        /*if (!empty($_SESSION['cart']['products'][$productName])) {
            $_SESSION['cart']['total_price'] = $_SESSION['cart']['total_price'] - $_SESSION['cart']['products'][$productName]['price'];
            unset($_SESSION['cart']['products'][$productName]);
        }*/

        $cart = $_POST['cart'];
        if (!empty($cart['products'][$productName])) {
            $cart['total_price'] = $cart['total_price'] - $cart['products'][$productName]['price'];
            unset($cart['products'][$productName]);
        }

        echo json_encode(['status' => 200, 'cart' => $cart]);
    }

    public function deliveryAddress()
    {
        $contactsData = $this->getContactInfo();
        $data['contacts'] = $contactsData;
        $data['action'] = 'delivery-address';
        //log the user in
        if (isset($_POST['login']) && !$this->isCustomerLoggedIn()) {
            if (!isset($_POST['email'])) {
                $_SESSION['error'] =  'Email is required';
                return;
            }
            if (!isset($_POST['password'])) {
                $_SESSION['error'] =  'Password is required';
                return;
            }
            $customer = new Customer();
            $data = array(
                'email' => $_POST['email'],
                'password' => md5($_POST['password']),
            );
            $returnedData = $customer->get($data, array(), "single");
            if (count($returnedData)) {
                $_SESSION['customer_email'] = $_POST['email'];
            } else {
                $_SESSION['error'] = "Credential invalid";
                $data['cartObjectAsString'] = $_POST['cart'];
                $data['order_process_type_id'] = $_POST['order_process_type_id'];
                $this->view('customer/login', $data);
                exit();
            }
        }
        //end of log in

        //register customer
        if (isset($_POST['register']) && !$this->isCustomerLoggedIn()) {
            $customerModel = new Customer();

            $customer = $customerModel->getWhere(['email' => $_POST['email']], [], 'single');
            //echo "<pre>";print_r($customer);echo "</pre>";return;
            if (!empty($customer)) {
                $_SESSION['error'] =  'This Email address has already been taken. Choose another';
                $data['cartObjectAsString'] = $_POST['cart'];
                $data['order_process_type_id'] = $_POST['order_process_type_id'];
                $this->view('customer/login', $data);
                exit();
            }
            $data = array(
                'first_name' => $_POST['first_name'],
                'last_name' => $_POST['last_name'],
                'email' => $_POST['email'],
                'mobile' => $_POST['mobile'],
                /*'phone' => $_POST['phone'],
                'flat_house_no' => $_POST['flat_house_no'],
                'street' => $_POST['street'],
                'city_town' => $_POST['city_town'],
                'postcode' => $_POST['postcode'],*/
                'password' => md5($_POST['password']),
            );
            $customer = new Customer();
            $returned = $customer->save($data);
            if ($returned['status'] == 200) {
                $_SESSION['customer_email'] = $_POST['email'];
            } else {
                $_SESSION['error'] = "Internal Database error! please try again";
                $data['cartObjectAsString'] = $_POST['cart'];
                $data['order_process_type_id'] = $_POST['order_process_type_id'];
                $this->view('customer/login', $data);
                exit();
            }
        }
        //end of register customer

        if (!$this->isCustomerLoggedIn()) {
            //$_SESSION['cartObjectAsString']
            //$this->redirect('/');
            $data['page'] = 'login';
            $data['cartObjectAsString'] = $_POST['cart'];
            $data['order_process_type_id'] = $_POST['order_process_type_id'];
            $this->view('customer/login', $data);
            exit();
        }

        $postcodeModel = new Postcode();
        $data['postcodes'] = $postcodeModel->getAll();
        $data['cartObjectAsString'] = $_POST['cart'];
        $data['order_process_type_id'] = $_POST['order_process_type_id'];

        //echo "<pre>"; print_r($data['postcodes']);echo "</pre>";exit();
        $data['page'] = 'delivery-address';
        $this->view('customer/delivery_address', $data);
    }

    public function messages()
    {
        $data['contacts'] = $this->getContactInfo();
        $openingHourModel = new OpeningHour();
        $openingHours = $openingHourModel->getFirst();
        $contactsData['opening_times'] = $this->formatOpeningHours($openingHours);
        $contactsData = $this->getContactInfo();
        $data['contacts'] = $contactsData;
        $data['page'] = 'thank-you';
        $data['h2Message'] = 'Thank You';
        $data['smallMessage'] = 'For being an AMAZING customer and having fantastic taste';
        $this->view('customer/messages', $data);
    }

    public function checkOut()
    {
        //echo "<pre>"; print_r($_POST);echo "</pre>";exit();
        $contactsData = $this->getContactInfo();
        $data['contacts'] = $contactsData;

        /*Calculating discount*/
        $cart = json_decode($_POST['cart']);
        $discountModel = new Discount();
        $discountData = $discountModel->getFirst();
        $_SESSION['discount_type'] = $discountData->discount_type;
        $_SESSION['minimum_amount'] = $discountData->min_amount;
        $_SESSION['maximum_amount'] = $discountData->max_amount;
        $_SESSION['discount_rate'] = $discountData->discount_rate;

        /*Calculating discount*/
        if($_SESSION['discount_type']==1 || ($_SESSION['discount_type']== 2 && $_POST['order_process_type_id']==1) || ($_SESSION['discount_type']== 3 && $_POST['order_process_type_id']==2)){
            if($_SESSION['discount_rate']!=0 || $_SESSION['discount_rate']!=''){
                if($_SESSION['minimum_amount']==0 && $_SESSION['maximum_amount']==0){
                    $discount_price = $cart->total_price*($_SESSION['discount_rate']/100);
                }
                else if($_SESSION['minimum_amount']!=0 && $_SESSION['maximum_amount']==0 && $cart->total_price >=$_SESSION['minimum_amount']){
                    $discount_price = $cart->total_price*($_SESSION['discount_rate']/100);
                }
                else if($_SESSION['minimum_amount']==0 && $_SESSION['maximum_amount']!=0 && $cart->total_price <=$_SESSION['maximum_amount']){
                    $discount_price = $cart->total_price*($_SESSION['discount_rate']/100);
                }
                else if($_SESSION['minimum_amount']!=0 && $_SESSION['maximum_amount']!=0 && $cart->total_price >=$_SESSION['minimum_amount'] && $cart->total_price <=$_SESSION['maximum_amount']){
                    $discount_price = $cart->total_price*($_SESSION['discount_rate']/100);
                }
                else{
                    $discount_price = 0;
                    $_SESSION['discount_rate'] = 0;
                }
            }
            else{
                $discount_price = 0;
                $_SESSION['discount_rate'] = 0;
            }
        }
        else{
            $discount_price = 0;
            $_SESSION['discount_rate'] = 0;
        }

        $_SESSION['discount_price'] = number_format($discount_price, 2, '.', '');

        /*End of Calculating discount*/

        $data['action'] = 'checkout';
        $customerModel = new Customer();
        //log the user in
        if (isset($_POST['login']) && !$this->isCustomerLoggedIn()) {
            if (!isset($_POST['email'])) {
                $_SESSION['error'] =  'Email is required';
                $_SESSION['activeTab'] = 'login';
                return;
            }
            if (!isset($_POST['password'])) {
                $_SESSION['error'] =  'Password is required';
                $_SESSION['activeTab'] = 'login';
                return;
            }
            $customer = new Customer();
            $data = array(
                'email' => $_POST['email'],
                'password' => md5($_POST['password']),
            );
            $returnedData = $customer->get($data, array(), "single");
            if (count($returnedData)) {
                $_SESSION['customer_id'] = $returnedData->customer_id;
                $_SESSION['customer_email'] = $_POST['email'];
            } else {
                $_SESSION['error'] = "Credential invalid";
                $_SESSION['activeTab'] = 'login';
                $data['cartObjectAsString'] = $_POST['cart'];
                $data['order_process_type_id'] = $_POST['order_process_type_id'];
                $this->view('customer/login', $data);
                exit();
            }
        }
        //end of log in

        //register customer
        if (isset($_POST['register']) && !$this->isCustomerLoggedIn()) {

            $customer = $customerModel->getWhere(['email' => $_POST['email']], [], 'single');
            //echo "<pre>";print_r($customer);echo "</pre>";return;
            if (!empty($customer)) {
                $_SESSION['error'] =  'This Email address has already been taken. Choose another';
                $_SESSION['activeTab'] = 'register';
                $data['cartObjectAsString'] = $_POST['cart'];
                $data['order_process_type_id'] = $_POST['order_process_type_id'];
                $this->view('customer/login', $data);
                exit();
            }
            $data = array(
                'first_name' => $_POST['first_name'],
                'last_name' => $_POST['last_name'],
                'email' => $_POST['email'],
                'mobile' => $_POST['mobile'],
                /*'phone' => $_POST['phone'],
                'flat_house_no' => $_POST['flat_house_no'],
                'street' => $_POST['street'],
                'city_town' => $_POST['city_town'],
                'postcode' => $_POST['postcode'],*/
                'password' => md5($_POST['password']),
            );
            $customer = new Customer();
            $returned = $customer->save($data);
            if ($returned['status'] == 200) {
                $newCustomer = $customer->getWhere(['email' => $_POST['email']]);
                if(mail($_POST['email'],'Signup Confirmation','Registration successful.')){
                    //echo json_encode(['status' => 200, 'message' => 'Successfully sent']);
                }
                else{
                    $_SESSION['error'] = "Email not sent";
                    $_SESSION['activeTab'] = 'register';
                    $this->redirect('login');
                }
                $_SESSION['customer_id'] = $newCustomer[0]->customer_id;
                $_SESSION['customer_email'] = $_POST['email'];
            } else {
                $_SESSION['error'] = "Internal Database error! please try again";
                $_SESSION['activeTab'] = 'register';
                $data['cartObjectAsString'] = $_POST['cart'];
                $data['order_process_type_id'] = $_POST['order_process_type_id'];
                $this->view('customer/login', $data);
                exit();
            }
        }
        //end of register customer

        if (!$this->isCustomerLoggedIn()) {
            //$_SESSION['cartObjectAsString']
            //$this->redirect('/');
            $data['page'] = 'login';
            $data['cartObjectAsString'] = $_POST['cart'];
            $data['order_process_type_id'] = $_POST['order_process_type_id'];
            $this->view('customer/login', $data);
            exit();
        }
        $contactsData = $this->getContactInfo();
        $data['contacts'] = $contactsData;

        $data['page'] = 'check-out';
        $settingsModel = new Settings();
        $data['settings'] = $settingsModel->getFirst();
        //$data['estimatedCollectionTime'] = $settings->estimated_collection_time;
        $deliverTimeModel = new DeliveryTime();
        $data['deliveryTimes'] = $deliverTimeModel->getAll();
        $orderProcessTypeModel = new OrderProcessType();
        $data['orderProcessType'] = $orderProcessTypeModel->getWhere(['order_process_type_id' => $_POST['order_process_type_id']], [], 'single');
        $data['order_process_type_id'] = $_POST['order_process_type_id'];
        $data['cart'] = json_decode($_POST['cart']);
        //echo "<pre>";print_r($data['cart']);echo "</pre>";exit();
        $data['cartObjectAsString'] = $_POST['cart'];
        $postcodeModel = new Postcode();
        $data['postcodes'] = $postcodeModel->getAll();
        $data['customer'] = $customerModel->getWhere(['email' => $_SESSION['customer_email']], [], 'single');

        $paymentTypeModel = new PaymentType();
        $data['paymentTypes'] = $paymentTypeModel->getWhere(['is_active' => true]);
        $data['card_payment_charge'] = CARD_PAYMENT_CHARGE;
        $this->view('customer/check_out', $data);
    }

    private function loginCheck()
    {
        //log the user in
        if (isset($_POST['login']) && !$this->isCustomerLoggedIn()) {
            if (!isset($_POST['email'])) {
                $_SESSION['error'] =  'Email is required';
                return;
            }
            if (!isset($_POST['password'])) {
                $_SESSION['error'] =  'Password is required';
                return;
            }
            $customer = new Customer();
            $data = array(
                'email' => $_POST['email'],
                'password' => md5($_POST['password']),
            );
            $returnedData = $customer->get($data, array(), "single");
            if (count($returnedData)) {
                $_SESSION['customer_email'] = $_POST['email'];
            } else {
                $_SESSION['error'] = "Credential invalid";
                $data['cartObjectAsString'] = $_POST['cart'];
                $data['order_process_type_id'] = $_POST['order_process_type_id'];
                $this->view('customer/login', $data);
                exit();
            }
        }
        //end of log in

        //register customer
        if (isset($_POST['register']) && !$this->isCustomerLoggedIn()) {
            $customerModel = new Customer();

            $customer = $customerModel->getWhere(['email' => $_POST['email']], [], 'single');
            //echo "<pre>";print_r($customer);echo "</pre>";return;
            if (!empty($customer)) {
                $_SESSION['error'] =  'This Email address has already been taken. Choose another';
                $data['cartObjectAsString'] = $_POST['cart'];
                $data['order_process_type_id'] = $_POST['order_process_type_id'];
                $this->view('customer/login', $data);
                exit();
            }
            $data = array(
                'first_name' => $_POST['first_name'],
                'last_name' => $_POST['last_name'],
                'email' => $_POST['email'],
                /*'phone' => $_POST['phone'],
                'mobile' => $_POST['mobile'],
                'flat_house_no' => $_POST['flat_house_no'],
                'street' => $_POST['street'],
                'city_town' => $_POST['city_town'],
                'postcode' => $_POST['postcode'],*/
                'password' => md5($_POST['password']),
            );
            $customer = new Customer();
            $returned = $customer->save($data);
            if ($returned['status'] == 200) {
                $_SESSION['customer_email'] = $_POST['email'];
            } else {
                $_SESSION['error'] = "Internal Database error! please try again";
                $data['cartObjectAsString'] = $_POST['cart'];
                $data['order_process_type_id'] = $_POST['order_process_type_id'];
                $this->view('customer/login', $data);
                exit();
            }
        }
        //end of register customer

        if (!$this->isCustomerLoggedIn()) {
            //$_SESSION['cartObjectAsString']
            //$this->redirect('/');
            $data['page'] = 'login';
            $data['cartObjectAsString'] = $_POST['cart'];
            $data['order_process_type_id'] = $_POST['order_process_type_id'];
            $this->view('customer/login', $data);
            exit();
        }
    }

    public function placeOrder()
    {
        $contactsData = $this->getContactInfo();
        $data['contacts'] = $contactsData;
        $cart = json_decode($_POST['cart']);
        $_SESSION['cart'] = $cart;
        $_SESSION['orderDetails']['order_process_type_id'] = $_POST['order_process_type_id'];
        $_SESSION['orderDetails']['order_delivery_time'] = $_POST['order_delivery_time'];
        $_SESSION['orderDetails']['order_instruction'] = $_POST['order_instruction'];
        $_SESSION['address1'] = (isset($_POST['address1'])) ? $_POST['address1']:'';
        $_SESSION['address2'] = (isset($_POST['address2'])) ? $_POST['address2']: '';
        $_SESSION['town'] = (isset($_POST['town'])) ? $_POST['town']:'';
        $_SESSION['postcode'] = (isset($_POST['town'])) ? $_POST['postcode']:'';
        $_SESSION['delivery_postcode'] = $_POST['postcode'];

        $discountModel = new Discount();
        $discountData = $discountModel->getFirst();
        $_SESSION['discount_type'] = $discountData->discount_type;
        $_SESSION['minimum_amount'] = $discountData->min_amount;
        $_SESSION['maximum_amount'] = $discountData->max_amount;
        $_SESSION['discount_rate'] = $discountData->discount_rate;

        /*Calculating discount*/
        if($_SESSION['discount_type']==1 || ($_SESSION['discount_type']== 2 && $_POST['order_process_type_id']==1) || ($_SESSION['discount_type']== 3 && $_POST['order_process_type_id']==2)){
            if($_SESSION['discount_rate']!=0 || $_SESSION['discount_rate']!=''){
                if($_SESSION['minimum_amount']==0 && $_SESSION['maximum_amount']==0){
                    $discount_price = $cart->total_price*($_SESSION['discount_rate']/100);
                }
                else if($_SESSION['minimum_amount']!=0 && $_SESSION['maximum_amount']==0 && $cart->total_price >=$_SESSION['minimum_amount']){
                    $discount_price = $cart->total_price*($_SESSION['discount_rate']/100);
                }
                else if($_SESSION['minimum_amount']==0 && $_SESSION['maximum_amount']!=0 && $cart->total_price <=$_SESSION['maximum_amount']){
                    $discount_price = $cart->total_price*($_SESSION['discount_rate']/100);
                }
                else if($_SESSION['minimum_amount']!=0 && $_SESSION['maximum_amount']!=0 && $cart->total_price >=$_SESSION['minimum_amount'] && $cart->total_price <=$_SESSION['maximum_amount']){
                    $discount_price = $cart->total_price*($_SESSION['discount_rate']/100);
                }
                else{
                    $discount_price = 0;
                    $_SESSION['discount_rate'] = 0;
                }
            }
            else{
                $discount_price = 0;
                $_SESSION['discount_rate'] = 0;
            }
        }
        else{
            $discount_price = 0;
            $_SESSION['discount_rate'] = 0;
        }

        $_SESSION['discount_price'] = number_format($discount_price, 2, '.', '');

        $_SESSION['payment_type'] = $_POST['payment_type'];

        if ($_POST['payment_type'] == 1) {
            $_SESSION['card_payment_charge'] = CARD_PAYMENT_CHARGE;
        }
        else{
            $_SESSION['card_payment_charge'] = 0;
        }

        $returnData = $this->completeOrder();
        $orderModel = new Order();
        $customerModel = new Customer();
        $where = ['email' => $_SESSION['customer_email']];
        $loggedInCustomer = $customerModel->getWhere($where, [], 'single');
        $lastOrderId = $orderModel->getLastInsertedId();
        $_SESSION['last_order_id'] = $lastOrderId;
        $flat_house_no = '';
        if (isset($loggedInCustomer->flat_house_no) && $loggedInCustomer->flat_house_no != ''){
            $flat_house_no = $loggedInCustomer->flat_house_no.', ';
        }
        $street = '';
        if (isset($loggedInCustomer->street) && $loggedInCustomer->street != ''){
            $street = $_SESSION['address2'];
        }
        $city_town = '';
        if (isset($loggedInCustomer->city_town) && $loggedInCustomer->city_town != '') {
            $city_town = $loggedInCustomer->city_town.', ';
        }
        $postcode = '';
        if (isset($loggedInCustomer->postcode) && $loggedInCustomer->postcode != '') {
            $postcode = $loggedInCustomer->postcode;
        }

        $order = $orderModel->getWhere(['order_id' => $lastOrderId], [], 'single');
        if ($returnData['status'] == 200) {
            /**
             * Write order details on order-print.txt file
             */

            $resId = 05;
            $orderType = $_POST['order_process_type_id']; // Delivery=1 or Collection=2
            $orderId = $lastOrderId;
            $deliveryCharge = number_format($cart->delivery_charge, 2, '.', '');
            $totalAmount = $cart->total_price - $_SESSION['discount_price'];
            $totalAmount = number_format($totalAmount, 2, '.', '');
            $customerName = $loggedInCustomer->first_name.' '.$loggedInCustomer->last_name;
            $customerAddress = $flat_house_no.$street.$city_town.$postcode;
            if($_SESSION['address2']!=''){
                $deliveryAddress = $_SESSION['address1'].', '.$_SESSION['address2'].', '.$_SESSION['town'].', '.$_SESSION['postcode'];
            }
            else{
                $deliveryAddress = $_SESSION['address1'].', '.$_SESSION['town'].', '.$_SESSION['postcode'];
            }
            $requestedTime = date('h:i m-d-y',strtotime($order->created_at));//"15:47 02-08-16";
            $deliveryTime = $_POST['order_delivery_time'];
            $previousOrderNumber = $lastOrderId - 1;
            $paymentStatus = 7; // Order paid=6 or Order not paid=7
            $customerPhone = $loggedInCustomer->mobile;
            $comment = $_POST['order_instruction'];
            if($_POST['payment_type']==1){
                $payment_type = 'Card';
            }
            else{
                $payment_type = 'Cash';
            }

            $items = '';
            foreach($cart->products as $crt){
                $items .= $crt->quantity.";".$crt->name.";".number_format($crt->price, 2, '.', '').";";
            }

            $items .= "1;Card payment charge;".number_format($_SESSION['card_payment_charge'], 2, '.', '').";";


            $fileName="order-print.txt";
            $file = BASE_DIR.'/'.$fileName;
            //$old_order = file_get_contents($file);

            for($i=1; $i<=1; $i++){ // write order details on order-print.txt file by checking if it is locked or not.
                $myfile = fopen($file,"w+");
                $new_order = "#".$resId."*".$orderType."*".$orderId."*".$items."*".$deliveryCharge."*".$_SESSION['discount_price'].";".$totalAmount.";4;".$customerName.";".$deliveryAddress.";".$deliveryTime.";".$previousOrderNumber.";".$paymentStatus.";".$payment_type.";".$customerPhone.";*".$comment."#
";
                fwrite($myfile,$new_order);
                flock($myfile,LOCK_EX);
                break;
            }

            // use loop to get order status by using stored procedure 'get_order_status_from_printer'
            //connect to database
            $status_reasons = array(
                'TOO_BUSY'=>'Sorry, we are now too busy. We can not deliver your order right now.',
                'FOOD_UNAVAILABLE'=>'Sorry, we can not deliver your order right now. The foods you ordered are unavailable.',
                'UNABLE_TO_DELIVER'=>'Sorry, We are unable to deliver your order right now.',
                'DONT_DELIVER_TO_AREA'=>'Sorry, we do not deliver order to this area.',
                'UNKNOWN_ADDRESS'=>'Sorry, we can not deliver your order. The address is unknown.',
                'TIME_UNAVAILABLE'=>'Sorry, we can not deliver your order this time.',
                'JAM_PLEASE_REORDER'=>'Sorry, there is jam. Please reorder.'
            );
            $status = 2;
            $data['status'] = 402;
            $data['reason'] = '';
            $count = 3;


            do {
                sleep(3);

                $orderPrint = $orderModel->getWhere(['order_id' => $orderId], [], 'single');

                $order_status = $orderPrint->order_status;

                if($count>40 && $order_status=='Pending'){ // If 'Pending' response found after 10 search attempt
                    $status = 0;
                    $data['status'] = 401;
                    $data['reason'] = "Restaurant not responding. Please retry.";

                    $myfile = fopen($file,"w+");
                    $new_order = "";
                    fwrite($myfile,$new_order);
                    flock($myfile,LOCK_UN);  //unlock file
                }

                if($order_status=='Accepted'){
                    $status = 3;
                    $data['status'] = 200;
                    $data['reason'] = $orderPrint->status_reason;
                }
                else if($order_status=='Rejected'){
                    $status = 4;
                    $data['status'] = 401;
                    $data['reason'] = $status_reasons[$orderPrint->status_reason];
                }
                $count = $count+3;
            }
            while ($status == 2);


            /**
             * Order writing end
             */

            if ($data['status'] == 200) {
                if (isset($_POST['payment_type'])) {
                    if ($_POST['payment_type'] == 1) {
                        if (!empty($cart->products)) {
                            //var_dump($cart->products);exit();
                            $this->payByPaypal($cart);
                        }
                    } else {
                        //$this->completeOrder('Cash');
                        //$data['errorMessage'] = $this->completeOrder('Cash');
                        $data['errorMessage'] = $this->completePayment('Cash');
                        $data['page'] = 'thank-you';
                        $data['h2Message'] = 'Thank You';
                        $data['smallMessage'] = 'For being an AMAZING customer and having fantastic taste';

                        $newOrder = $orderModel->getWhere(['order_id' => $_SESSION['last_order_id']], [], 'single');
                        $data['orderNumber'] = $_SESSION['last_order_id'];
                        $cart = $_SESSION['cart'];
                        $data['totalAmount'] = $cart->total_price+$_SESSION['card_payment_charge']-$_SESSION['discount_price'];
                        $data['orderTime'] = !empty($newOrder) ? $newOrder->printer_delivery_time:null;
                        //echo "<pre>";print_r($_SESSION);echo "</pre>";exit();
                        unset($_SESSION['cart']);
                        unset($_SESSION['last_order_id']);

                        $this->view('customer/messages', $data);
                    }
                } else {
                    echo "You must select payment option";exit();
                }
            } else {
                $data['errorMessage'] = $data['reason'];
                $this->view('customer/messages', $data);
            }
        } else {
            $data['errorMessage'] = "We are sorry, right now we are unable to process your order";
            $this->view('customer/messages', $data);
        }


        //echo "<pre>";print_r($cart->products);echo "</pre>";exit();
    }

    public function paypalReturn()
    {
        $contactsData = $this->getContactInfo();
        $data['contacts'] = $contactsData;
        //var_dump($_GET['paymentId']);exit();
        if ($_GET['success'] == 'true') {
            //$data['message'] = $this->completeOrder('Card');
            $data['message'] = $this->completePayment('Card');
            $data['page'] = 'thank-you';
            $data['h2Message'] = 'Thank You';
            $data['smallMessage'] = 'For being an AMAZING customer and having fantastic taste';

            $orderModel = new Order();
            $newOrder = $orderModel->getWhere(['order_id' => $_SESSION['last_order_id']], [], 'single');
            $data['orderNumber'] = $_SESSION['last_order_id'];
            $cart = $_SESSION['cart'];
            $data['totalAmount'] = $cart->total_price;
            $data['orderTime'] = !empty($newOrder) ? $newOrder->printer_delivery_time:null;

            unset($_SESSION['cart']);
            unset($_SESSION['last_order_id']);

            $this->view('customer/messages', $data);
        } else {
            //echo 'Failed payment';
            $data['errorMessage'] = 'Payment failed';
            $data['page'] = 'thank-you';
            $this->view('customer/messages', $data);
        }

    }

    private function completeOrder()
    {
        if (isset($_SESSION['cart'])) {
            $message = null;
            $cart = $_SESSION['cart'];
            $orderModel = new Order();
            $customerModel = new Customer();
            $where = ['email' => $_SESSION['customer_email']];
            $loggedInCustomer = $customerModel->getWhere($where, [], 'single');
            //echo "<pre>";print_r($loggedInCustomer);echo "</pre>";exit();
            $date = new \DateTime();
            /*$data = array(
                'customer_id' => $loggedInCustomer->customer_id,
                'cart_id' => 1,
                'payment_id' => $_GET['paymentId'],
                'subtotal' => $cart['total_price'],
                'total' => $cart['total_price'],
                'order_status' => 'Pending',
                'order_process' => 'Collection',
                'postcode_id' => '1',
                'flat_house_no' => '1',
                'city_town' => '1',
                'postcode' => '1',
                'created_at' => $date->format('Y-m-d h:i:s'),
            );*/


            $paymentId = '0';
            if (isset($_GET['paymentId'])) {
                $paymentId = $_GET['paymentId'];
            }


            //$flat_house_no = $loggedInCustomer->flat_house_no;
            if (isset($_SESSION['address1'])){
                $flat_house_no = $_SESSION['address1'];
            }
            $street = $loggedInCustomer->street;
            if (isset($_SESSION['address2']) && $_SESSION['address2']!=''){
                $flat_house_no .= ', '.$_SESSION['address2'];
                $street = $_SESSION['address2'];
            }
            $city_town = $loggedInCustomer->city_town;
            if (isset($_SESSION['town'])) {
                $city_town = $_SESSION['town'];
            }
            $postcode = $loggedInCustomer->postcode;
            if (isset($_SESSION['postcode'])) {
                $postcode = $_SESSION['postcode'];
            }
            $total_price = $cart->total_price + $_SESSION['card_payment_charge'] - $_SESSION['discount_price'];

            $data = array(
                'customer_id' => $loggedInCustomer->customer_id,
                //'cart_id' => 1,
                'payment_id' => $paymentId,
                'subtotal' => $cart->sub_total_price,
                'discount' => $_SESSION['discount_price'],
                'total' => $total_price,
                'delivery_charge' => $cart->delivery_charge,
                'card_payment_charge' => $_SESSION['card_payment_charge'],
                'order_status' => 'Pending',
                'order_process_type_id' => $_SESSION['orderDetails']['order_process_type_id'],
                'postcode_id' => '1',
                'flat_house_no' => $flat_house_no,
                'city_town' => $city_town,
                'street' => $street,
                'postcode' => $postcode,
                'order_delivery_day' => $date->format('Y-m-d'),
                'order_delivery_time' => $_SESSION['orderDetails']['order_delivery_time'],
                'order_instruction' => $_SESSION['orderDetails']['order_instruction'],
                'created_at' => $date->format('Y-m-d h:i:s'),
            );

            $returnData = $orderModel->save($data);


            $lastOrderId = $orderModel->getLastInsertedId();

            $orderDetailsModel = new OrderDetails();
            foreach($_SESSION['cart']->products as $product){
                $order_details = array(
                    'order_id' => $lastOrderId,
                    'product_id' => $product->product_id,
                    'sub_product_id' => $product->sub_product_id,
                    'customer_id' => $_SESSION['customer_id'],
                    'quantity' => $product->quantity,
                    'price' => $product->price,
                );
                $orderDetailsModel->save($order_details);
            }

            /*if ($returnData['status'] == 200) {

                $paymentData = array(
                    'order_id' => $orderModel->getLastInsertedId(),
                    'payment_amount' => $cart->total_price,
                    'payment_type' => $paymentType,
                    'tranjaction_response' => json_encode($_GET),
                    'total_amount' => $cart->total_price,
                    'transaction_id' => $transactionId,
                );
                $paymentModel = new \App\model\Payment();
                $savePayment = $paymentModel->save($paymentData);
                if ($savePayment['status'] == 200) {
                    unset($_SESSION['cart']);
                    unset($_SESSION['orderDetails']);
                    //$message =  'Successful';

                } else {
                    $message = 'Failed data insertion in Payment';
                }

                //echo json_encode(['status' => 200, 'message' => ]);
            } else {
                $message = 'Failed data insertion in order';
                //echo json_encode(['status' => 200, 'message' => 'Internal server error']);
            }

            return $message;*/

            return $returnData;
        }
    }

    private function completePayment($paymentType)
    {
        $message = null;
        $cart = $_SESSION['cart'];
        $orderModel = new Order();
        $transactionId = 0;
        if (isset($_GET['transaction_id'])) {
            $transactionId = $_GET['transaction_id'];
        }
        $paymentData = array(
            'order_id' => $orderModel->getLastInsertedId(),
            'payment_amount' => $cart->total_price - $_SESSION['discount_price'],
            'payment_type' => $paymentType,
            'tranjaction_response' => json_encode($_GET),
            'total_amount' => $cart->total_price,
            'transaction_id' => $transactionId,
        );
        $paymentModel = new \App\model\Payment();
        $savePayment = $paymentModel->save($paymentData);
        if ($savePayment['status'] == 200) {
            //unset($_SESSION['cart']);
            unset($_SESSION['orderDetails']);
            $orderModel->update(['order_status' => 'Complete'], ['order_id' => $_SESSION['last_order_id']]);

            /* Here the email is sent through the following function */
            $send_order_confirmation_email = $this->sendOrderConfirmationEmail($paymentData, $cart);

            if($send_order_confirmation_email == 'success'){
                $_SESSION['success'] = "Order confirmation email has been sent to your email address";
            }else{
                $_SESSION['error'] = "Email not sent";
            }

        } else {
            $message = 'Failed data insertion in Payment';
        }

        return $message;
    }

    public function sendOrderConfirmationEmail($paymentData, $cart){

        $base_url = DOMAIN.BASE_URL;
        $order_id = $paymentData['order_id'];

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
        if($order_details_data->order_process_type_id == 1){
            if(isset($_SESSION['address1']) && !empty($_SESSION['address1'])){
                array_push($raw_address, $_SESSION['address1']);
                unset($_SESSION['address1']);
            }
            if(isset($_SESSION['address2']) && !empty($_SESSION['address2'])){
                array_push($raw_address, $_SESSION['address2']);
                unset($_SESSION['address2']);
            }
            if(isset($_SESSION['town']) && !empty($_SESSION['town'])){
                array_push($raw_address, $_SESSION['town']);
                unset($_SESSION['town']);
            }
        }else{
            if(isset($order_details_data->flat_house_no) && !empty($order_details_data->flat_house_no)){
                array_push($raw_address, $order_details_data->flat_house_no);
            }
            if(isset($order_details_data->street) && !empty($order_details_data->street)){
                array_push($raw_address, $order_details_data->street);
            }
            if(isset($order_details_data->city_town) && !empty($order_details_data->city_town)){
                array_push($raw_address, $order_details_data->city_town);
            }
        }

        $customer_address = implode(', ', $raw_address);
        $delivery_address = $order_details_data->delivery_address;
        if($order_details_data->delivery_city_town!=''){
            $delivery_address .= ', '.$order_details_data->delivery_city_town;
        }

        $customer_email = $order_details_data->email;
        $customer_phone = $order_details_data->mobile;
        $customer_postcode = $order_details_data->postcode;
        $delivery_postcode = $_SESSION['delivery_postcode'];
        $payment_type = $paymentData['payment_type'];

        $sub_total = (isset($order_details_data->subtotal) && !empty($order_details_data->subtotal)) ? $order_details_data->subtotal : 0;
        $delivery_charge = (isset($order_details_data->delivery_charge) && !empty($order_details_data->delivery_charge)) ? $order_details_data->delivery_charge : 0;
        $card_payment_charge = (isset($order_details_data->card_payment_charge) && !empty($order_details_data->card_payment_charge)) ? $order_details_data->card_payment_charge : 0;
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
        $company_address_email = $raw_company_address_email->contact_email1;

        $raw_company_address_phone = json_decode($contacts->phone);
        $company_address_phone = $raw_company_address_phone->header_phone1;

        $from = FROM_EMAIL; // get email from config file.
        $to = array($customer_email, $company_address_email);
        $subject = "Order Information";

        $message = "
            <body style=\"margin: 0;font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif;font-size: 14px;line-height: 1.42857143;color: #333;background-color: #fff;\">
                <div class=\"container\" style=\"padding-right: 15px; padding-left: 15px; margin-right: auto; margin-left: auto; width:80%;\">
                    <div class=\"effect02\" style=\"background: rgb(0, 0, 0) none repeat scroll 0% 0%; margin-top: 30px; width: 100%; padding: 1px 0px;\">
                        <img src=\"$base_url/assets/customer/img/logo.kpg.png\" alt=\"logo\" style=\"width: 250px; margin: 30px auto; float: none; display: block;\">
                    </div>
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
                                    <td width=\"30 % \" style=\"line-height: 1.2;vertical-align: top;border-top: 0px none !important;background-color: #fff !important;border: 1px solid black;padding: 6px 12px;\">Postcode:</td>
                                    <td style = \"line-height: 1.2;vertical-align: top;border-top: 0px none !important;background-color: #fff !important;border: 1px solid black;padding: 6px 12px;\" > $delivery_postcode</td >
                                </tr >
                                <tr>
                                    <td width=\"30%\" style=\"line-height: 1.2;vertical-align: top;border-top: 0px none !important;background-color: #fff !important;border: 1px solid black;padding: 6px 12px;\">Email:</td>
                                    <td style=\"line-height: 1.2;vertical-align: top;border-top: 0px none !important;background-color: #fff !important;border: 1px solid black;padding: 6px 12px;\">$customer_email</td>
                                </tr>
                                <tr>
                                    <td width=\"30%\" style=\"line-height: 1.2;vertical-align: top;border-top: 0px none !important;background-color: #fff !important;border: 1px solid black;padding: 6px 12px;\">Phone:</td>
                                    <td style=\"line-height: 1.2;vertical-align: top;border-top: 0px none !important;background-color: #fff !important;border: 1px solid black;padding: 6px 12px;\">$customer_phone</td>
                                </tr>    
                                <tr>
                                    <td width=\"30%\" style=\"line-height: 1.2;vertical-align: top;border-top: 0px none !important;background-color: #fff !important;border: 1px solid black;padding: 6px 12px;\">Pay by:</td>
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
        foreach ($cart->products as $key=>$value){
            $message .= "<tr>";
            $message .= "<td style=\"text-align: center;border: 1px solid black;padding: 6px 12px;\">$value->quantity</td>";
            $message .= "<td style=\"border: 1px solid black;padding: 6px 12px;\">$value->name</td>";
            $message .= "<td width=\"15%\" style=\"text-align: right;border: 1px solid black;padding: 6px 12px;\">&pound;$value->price</td>";
            $message .= "</tr>";
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
                                        <td style=\"text-align: right; font-weight: 600;border: 1px solid black;padding: 6px 12px;\">Delivery Charge:</td>
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

        $send_order_confirmation_email = $this->sendEmail($from, $to, $subject, $message);

        return $send_order_confirmation_email;
    }

    public function payByPaypal($cart)
    {
        $data['business_email'] = PAYPAL_MARCHANT_EMAIL;
        $data['currency'] = 'GBP';
        $data['item_name'] = 'Online restaurent items';
        $data['total_amount'] = $cart->total_price + $_SESSION['card_payment_charge'] - $_SESSION['discount_price'];
        $data['return_url'] = DOMAIN.BASE_URL."/paypal-return?success=true";
        $data['cancel_url'] = DOMAIN.BASE_URL."/paypal-return?success=false";

        $this->view('customer/paypal_form',$data); exit();

        //echo "<pre>";print_r($cart);echo "</pre>";exit();
        /*$apiContext = new ApiContext(
            new OAuthTokenCredential(
                PAYPAL_CLIENT_ID,     // ClientID from config file
                PAYPAL_CLIENT_SECRET      // ClientSecret from config file.
            )
        );

        $apiContext->setConfig(
            array(
                    'mode' => 'live',
                  )
            );

        $payer = new Payer();
        $payer->setPaymentMethod("paypal");

        $items = array();
        $counter = 1;

        foreach ($cart->products as $product) {
            //echo "<pre>";print_r($product);echo "</pre>";
            $item = new Item();
            $item->setName($product->name)
                ->setCurrency("GBP")
                ->setQuantity(1) //$product->quantity
                ->setSku($product->name) // Similar to `item_number` in Classic API
                ->setPrice($product->price);
            $items[] = $item;
            $counter++;
        }
        $item_discount = new Item();
        $item_discount->setName('Discount')
        ->setCurrency("GBP")
        ->setQuantity(1) //$product->quantity
        ->setPrice(-$_SESSION['discount_price']);
        $items[] = $item_discount;

        //echo "<pre>";print_r($items);echo "</pre>";exit();

        $itemList = new ItemList();
        $itemList->setItems($items);

        $details = new Details();
        $details->setShipping($cart->delivery_charge)
            ->setTax(0)
            ->setSubtotal($cart->sub_total_price - $_SESSION['discount_price']);

        $amount = new Amount();

        $amount->setCurrency("GBP")
            ->setTotal($cart->total_price - $_SESSION['discount_price'])
            ->setDetails($details);

        //echo "<pre>";print_r($amount);echo "</pre>";exit();

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription("Payment description")
            ->setInvoiceNumber(uniqid());


        //$baseUrl = getBaseUrl();
        //var_dump("http://localhost/".BASE_URL);exit();
        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl(DOMAIN.BASE_URL."/paypal-return?success=true")
            ->setCancelUrl(DOMAIN.BASE_URL."/paypal-return?success=false");

        $payment = new Payment();
        $payment->setIntent("sale")
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions(array($transaction));


        $request = clone $payment;

        try {
            $payment->create($apiContext);
            //echo "<pre>";print_r($payment);echo "</pre>";exit();
        } catch (\Exception $ex) {
            print_r($ex);
            //\ResultPrinter::printError("Created Payment Using PayPal. Please visit the URL to Approve.", "Payment", null, $request, $ex);
            exit(1);
        }

        $approvalUrl = $payment->getApprovalLink();
        //var_dump($approvalUrl);exit();

        echo '<script> window.location="'.$approvalUrl.'"; </script>';
        exit();*/
    }

    public function contactUs()
    {
        $contactsData = $this->getContactInfo();
        $data['contacts'] = $contactsData;
        $openingHourModel = new OpeningHour();
        $openingHours = $openingHourModel->getFirst();
        $contactsData['opening_times'] = $this->formatOpeningHours($openingHours);
        $data['page'] = 'contact-us';
        $this->view('customer/contact_us', $data);
    }

    public function sendContactEmail()
    {
        $to = $_POST['to_email'];
        $from = $_POST['email'];
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $subject = $_POST['subject'];
        $message = "
                <body>
                <p>".$_POST['message']."</p>
                <table>
                    <tr>
                        <td>Regards</td>
                    </tr>
                    <tr>
                        <td>".$name."</td>
                    </tr>
                    <tr>
                        <td>".$phone."</td>
                    </tr>
                </table>
                </body>
                ";

        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        // More headers
        $headers .= "From: <".$from.">" . "\r\n";
        //$headers .= 'Cc: myboss@example.com' . "\r\n";

        if(mail($to,$subject,$message,$headers)){
            echo json_encode(['status' => 200, 'message' => 'Successfully sent']);
        }
        else{
            echo json_encode(['status' => 501, 'message' => 'Email not sent']);
        }
    }
    public function aboutUs()
    {
        $contactsData = $this->getContactInfo();
        $data['contacts'] = $contactsData;
        $pageModel = new Page();
        $data['about_us'] = $pageModel->getAll();
        $data['page'] = 'about-us';
        $this->view('customer/about_us', $data);
    }

    public function profile()
    {
        //if customer is not logged in then redirect to login page
        if (!$this->isCustomerLoggedIn()) {
            $data['page'] = 'login';
            $_SESSION['redirect_url'] = 'profile';
            $this->redirect('login');
        }
        $customerModel = new Customer();
        $data['customer'] = $customerModel->getWhere(['customer_id' => $_SESSION['customer_id']], [], 'single');

        $contactsData = $this->getContactInfo();
        $data['contacts'] = $contactsData;
        $data['page'] = 'profile';
        $this->view('customer/profile', $data);
    }

    /*
     * Commented by 14010303
     * */

    public function changeCustomerPassword(){
        $contactsData = $this->getContactInfo();
        $data['contacts'] = $contactsData;
        $data['page'] = 'change password';
        $this->view('customer/change_password', $data);
    }

    public function updateCustomerPassword(){
        $customerModel = new Customer();
        $customerData = $customerModel->getWhere(['customer_id' => $_SESSION['customer_id']], [], 'single');

        if($customerData->password!=MD5($_POST['current_password'])){
            echo json_encode(['status' => 500, 'message' => 'Current password is not valid']);
        }
        else{
            $data = array(
                'password' => MD5($_POST['new_password'])
            );
            $where = ['customer_id' => $_SESSION['customer_id']];
            $returnData = $customerModel->update($data, $where);

            if ($returnData['status'] == 200) {
                echo json_encode(['status' => 200, 'message' => 'Password changed', 'setting_data' => '']);
                return;
            } else {
                echo json_encode(['status' => 500, 'message' => $returnData['message']]);
                return;
            }
        }

    }

    public function changeCustomerAddrss(){
        if (!$this->isCustomerLoggedIn()) {
            $data['page'] = 'login';
            $_SESSION['redirect_url'] = 'profile';
            $this->redirect('login');
        }
        $customerModel = new Customer();
        $data['customer'] = $customerModel->getWhere(['customer_id' => $_SESSION['customer_id']], [], 'single');
        //echo "<pre>"; print_r($data['customer']); echo "</pre>"; exit();

        $contactsData = $this->getContactInfo();
        $data['contacts'] = $contactsData;
        $data['page'] = 'change address';
        $this->view('customer/change_address', $data);
    }

    public function updateCustomerAddrss(){
        $customerModel = new Customer();
        $data = array(
            'first_name' => $_POST['first_name'],
            'last_name' => $_POST['last_name'],
            'phone' => $_POST['phone'],
            'mobile' => $_POST['mobile'],
            'flat_house_no' => $_POST['flat_house_no'],
            'street' => $_POST['street'],
            'city_town' => $_POST['city_town'],
            'postcode' => $_POST['postcode']
        );
        $where = ['customer_id' => $_SESSION['customer_id']];
        $returnData = $customerModel->update($data, $where);

        if ($returnData['status'] == 200) {
            echo json_encode(['status' => 200, 'message' => $returnData['message'], 'setting_data' => '']);

            return;
        } else {
            echo json_encode(['status' => 500, 'message' => $returnData['message']]);

            return;
        }
    }

    public function getAddressByPostcode()
    {
        try {
            $postcode = $_POST['postcode'];
            $modifiedPostCode = explode(' ', trim($postcode));
            //echo count($modifiedPostCode);exit();
            //$postcode = substr($postcode, 0, 6);
            /*echo $postcode;
            exit();*/
            $addressModel = new Address();
            //$data['addressees'] = $addressModel->getWhere(['Postcode' => $postcode]);
            $data['addressees'] = $addressModel->getRaw("select * from address where Postcode = '{$postcode}'");
            //if ($data['addressees'] == "" || count($modifiedPostCode) < 2 ) {
            if ($data['addressees'] == "" ) {
                $data['status'] = 500;
                //$data['message'] = 'There is no address of the given postcode. Right format of the post code is E14 9TX';
                $data['message'] = 'There is no address of the given postcode.';
            } else {
                $data['status'] = 200;
            }

            echo json_encode($data);

        } catch (\Exception $ex) {
            print_r($ex);
            //\ResultPrinter::printError("Created Payment Using PayPal. Please visit the URL to Approve.", "Payment", null, '', $ex);
            exit(1);
        }
        exit();
    }

    public function checkAvailableOpeningTime()
    {
        $openingHourModel = new OpeningHour();
        $openingHours = $openingHourModel->getFirst();
        $today = strtolower(date('l'));
        $openingHour = json_decode($openingHours->{$today});
        $current_time = date('h:i A');
        $isOpen = $openingHour->is_open;
        $date1 = \DateTime::createFromFormat('h:i a', $current_time);


        $open=0;

        /*Calculate opening hour for previous day to check if time was set for current day in previous day slot. i.e. 10:00pm - 2:00 am*/
        $time = time();
        $prev_day = date("l", mktime(0,0,0,date("n", $time),date("j",$time)- 1 ,date("Y", $time)));
        $prev_day = strtolower($prev_day);
        $prev_day_openingHour = json_decode($openingHours->{$prev_day});
        $date_data = '';
        foreach($prev_day_openingHour->times as $time){
            $start_am_pm = explode(" ", $time->start_time);
            $end_am_pm = explode(" ", $time->end_time);
            if($start_am_pm[1]=='pm' && $end_am_pm[1]=='am'){
                $start_time = '12:00 am';
                $end_time = $time->end_time;
                $date2 = \DateTime::createFromFormat('h:i a', $start_time);
                $date3 = \DateTime::createFromFormat('h:i a', $end_time);
                $date_data .= $current_time." ".$time->start_time." ".$time->end_time;

                if ($open==0 && $date1 > $date2 && $date1 < $date3) {
                    $open = 1;
                }
            }
        }

        /*Calculate opening hour for previous day ends */

        if ($isOpen != 0 ) {
            if($openingHour->times[0]->start_time == '24 hours'){
                echo "</br>open time=24 hour</br>";
                echo json_encode(['status' => 200]);
            }
            else{
                if($open==0){
                    foreach($openingHour->times as $time){
                        $explode_start_time = explode(' ',$time->start_time); // to get a.m or p.m.
                        $explode_end_time = explode(' ',$time->end_time); // to get a.m or p.m.
                        $explode_end_minute = explode(':',$explode_end_time[0]); // to get minute value ie 1 from 1:30
                        if($explode_start_time[1]=='pm' && $explode_end_time[1]=='am' && $explode_end_minute[0]<=12){ // if end time is next day
                            $time->end_time = '11:59 pm';
                        }
                        $date2 = \DateTime::createFromFormat('h:i a', $time->start_time);
                        $date3 = \DateTime::createFromFormat('h:i a', $time->end_time);
                        if ($open==0 && $date1 > $date2 && $date1 < $date3) {
                            $open = 1;
                        }
                    }
                }

                if($open==1){
                    echo json_encode(['status' => 200, 'message'=>'Restaurant is open']);
                }
                else{
                    //echo json_encode(['status' => 500, 'message' => $date_string]);
                    echo json_encode(['status' => 500, 'message' => 'Our restaurant is closed now.']);
                }
            }
        } else {
            echo json_encode(['status' => 500, 'message' => 'Our restaurant is closed now.']);
        }
    }

    public function forgetPassword()
    {
        $data['contacts'] = $this->getContactInfo();
        $this->view('customer/forget_password', $data);
    }

    /**
     * function for sending forgot password recovery email with recovery link
     */
    public function postForgetPassword()
    {
        $email = $_POST['email'];
        $customerModel = new Customer();
        $newCustomer = $customerModel->getWhere(['email' => $_POST['email']], [], 'single');
        //print_r($_POST);
        //exit();
        if (!empty($newCustomer)) {
            $encryptedData = base64_encode($newCustomer->customer_id.'_'.$newCustomer->email);
            $send_to = array($newCustomer->email);
            $subject = 'Forgot Password Confirm';
            $base_url = DOMAIN.BASE_URL;

            $link = $base_url.'/reset-password?q='.$encryptedData;

            $message = "
                <body style=\"margin: 0;font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif;font-size: 14px;line-height: 1.42857143;color: #333;background-color: #fff;\">
         
                    <div class=\"container\" style=\"padding-right: 15px; padding-left: 15px; margin-right: auto; margin-left: auto; width:80%;\">
                        <div class=\"effect02\" style=\"background: rgb(0, 0, 0) none repeat scroll 0% 0%; margin-top: 30px; width: 100%; padding: 1px 0px;\">
                            <img src=\"$base_url/assets/customer/img/logo.kpg.png\" alt=\"logo\" style=\"width: 250px; margin: 30px auto; float: none; display: block;\">
                        </div>
                        
                        <div style=\"margin-right: -15px;margin-left: -15px;\">
                            <div style=\"position: relative;min-height: 1px;padding-right: 15px;padding-left: 15px;float: left;width: 96%;\">
                                <p style=\"margin-top: 20px;\">If you need to make any changes for forgot password, please call (00) 14525 5688</p>
                                <h3 style=\"margin: 30px 0; font-weight: 600; text-align:center;\">Forgot Password Details</h3>
                                <p style=\"font-size: 17px; font-weight: 300;\">
                                    To initiate the password reset process for your<br>
                                    <a href=\"#\">$newCustomer->email </a>Food Lover Account, click the link below:<br>
                                    <a href=\"$link\">$link</a><br>
                                    If clicking the link above doesn't work, please copy and paste the URL in a new
                                    browser window instead. If you've received this mail in error, it's likely that another
                                    user entered your email address by mistake while trying to reset a password. If
                                    you didn't initiate the request, you don't need to take any further action and can
                                    safely disregard this email. Sincerely, The Chefonline Team Note: This email
                                    address cannot accept replies.
                                </p>
                
                                <p style=\"margin:5px 0\">Best Regards</p>
                                <p style=\"margin:5px 0\"><b>Food Lover</b></p>
                                <p style=\"margin:5px 0\"><b>Tel: (00) 14525 5688</b></p>
                                <hr style=\"margin: 50px 0px; border-top: 0px solid rgb(252, 252, 252);\" />
                                
                                <div style=\"text-align: center; margin-bottom: 25px;\">
                                    <img style=\"width: 100px; margin:0 auto; display: block;\" src=\"$base_url/assets/customer/img/footer-logo.jpg\">
                                    <small style=\"\">2017 © Food Lover. ALL Rights Reserved.</small>
                                </div>
                
                            </div>
                        </div>
                    </div>
                 </body>
            ";

            $send_registration_email = $this->sendEmail('support@madinacharcoalgrill.com', $send_to, $subject, $message);

            if($send_registration_email == 'success'){
                $_SESSION['success'] = "We have sent you an email with instructions for how to reset your password.";
            }else{
                $_SESSION['error'] = "Email not sent";
            }
        } else {
            $_SESSION['error'] = "We do not have any records of the email";
        }
        $this->redirect('forget-password');
    }

    public function resetPassword()
    {

        $encrypted = $_GET['q'];
        $encrypted = base64_decode($encrypted);
        $encrypted = explode('_', $encrypted);
        //echo "<pre>"; print_r($encrypted);echo "</pre>";exit();
        $_SESSION['forget_password_id'] = $encrypted[0];
        $_SESSION['forget_password_email'] = $encrypted[1];
        $data['contacts'] = $this->getContactInfo();
        $this->view('customer/reset_password', $data);
    }

    public function postResetPassword()
    {
        $password = $_POST['password'];
        $customerModel = new Customer();
        $returnData = $customerModel->update(['password' => md5($password)], ['customer_id' => $_SESSION['forget_password_id']]);
        if ($returnData['status'] = 200) {
            $_SESSION['customer_id'] = $_SESSION['forget_password_id'];
            $_SESSION['customer_email'] = $_SESSION['forget_password_email'];
            unset($_SESSION['forget_password_email']);
            unset($_SESSION['forget_password_id']);
            $this->redirect('profile');
        } else {
            $_SESSION['error'] = $returnData['message'];
        }
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

    public function commonErrorMessage()
    {
        $contactsData = $this->getContactInfo();
        $openingHourModel = new OpeningHour();
        $openingHours = $openingHourModel->getFirst();
        $contactsData['opening_times'] = $this->formatOpeningHours($openingHours);
        $data['contacts'] = $contactsData;
        $data['errorMessage'] = '';
        //var_dump($_GET);exit();
        if (isset($_SESSION['errorMsg'])) {
            $data['errorMessage'] = $_SESSION['errorMsg'];
            unset($_SESSION['errorMsg']);
        }
        if(isset($_GET['errorMsg']) && $_GET['errorMsg'] != '') {
            $data['errorMessage'] = $_GET['errorMsg'];
        }
        $this->view('customer/messages', $data);
    }


    function customerInfo(){
        if (!$this->isAdminLoggedIn()) {
            $this->redirect('admin/login');
        }

        $data = array();
        $pagination = array();
        $rec_limit = 10;

        $order = new Order();
        $sql = "SELECT * FROM `customers`";

        $print_sql = "SELECT * FROM `customers`";

        $total_sql = "SELECT count(*) as total_customers FROM `customers`";

        if(isset($_GET['page']) && !empty($_GET['page'])){
            $page = $_GET{'page'} + 1;
            $offset = $rec_limit * $page ;
        }else{
            $page = 0;
            $offset = 0;
        }
        $sql .= " LIMIT $offset, $rec_limit";

        $customers = $order->getRaw($sql);
        $print_customers = $order->getRaw($print_sql);

        $total_customers = $order->getRaw($total_sql, 'single');
        $max_pagination = intval($total_customers->total_customers / 10);

        if(isset($customers) && !empty($customers)) {
            foreach ($customers as $key => $val) {
                $raw_address = array();
                if(isset($val->flat_house_no) && !empty($val->flat_house_no)){
                    $customers[$key]->address1 = $val->flat_house_no;
                }else{
                    $customers[$key]->address1 = '';
                }
                if(isset($val->street) && !empty($val->street)){
                    array_push($raw_address, $val->street);
                }
                if(isset($val->city_town) && !empty($val->city_town)){
                    array_push($raw_address, $val->city_town);
                }

                $customers[$key]->address2 = implode(', ', $raw_address);
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

        if(isset($print_customers) && !empty($print_customers)) {
            foreach ($print_customers as $key => $val) {
                $raw_address = array();
                if(isset($val->flat_house_no) && !empty($val->flat_house_no)){
                    $print_customers[$key]->address1 = $val->flat_house_no;
                }else{
                    $print_customers[$key]->address1 = '';
                }
                if(isset($val->street) && !empty($val->street)){
                    array_push($raw_address, $val->street);
                }
                if(isset($val->city_town) && !empty($val->city_town)){
                    array_push($raw_address, $val->city_town);
                }

                $print_customers[$key]->address2 = implode(', ', $raw_address);
            }
        }

        $contactsData = $this->getContactInfo();

        $data['customers'] = $customers;
        $data['print_customers'] = $print_customers;
        $data['contacts'] = $contactsData;
        $data['pagination'] = $pagination;
        $data['max_pagination'] = $max_pagination - 1;

        $this->view('admin/customer_info', $data);
    }

    public function orderCallback($orderId){
        // update this order's status to either accepted or rejected.
        $orderModel = new Order();
        $where = ['order_id' => $orderId];
        $orderData = array(
            'order_status' => 'Accepted',
            'status_reason' => 'Successfully printed',
            'printer_delivery_time' => ''
        );
        $returnData = $orderModel->update($orderData, $where);

    }

}