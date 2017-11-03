<?php
namespace App\controller;
/**
 * Created by PhpStorm.
 * User: b16030315
 * Date: 1/4/17
 * Time: 6:28 PM
 */
/*require_once 'BaseController.php';
require_once 'model/User.php';
require_once 'model/Customer.php';*/
use App\model\Contact;
use App\model\Customer;
use App\model\OpeningHour;
use App\model\User;

/**
 * Class AuthenticationController
 * @package App\controller
 */
class AuthenticationController extends BaseController
{
    public function register()
    {
        $this->view('admin/register');
    }

    public function adminLogin()
    {
        if ($this->isAdminLoggedIn()) {
            $this->redirect('admin/products');
        }

        $this->view('admin/login');
    }

    public function checkAdminLogin()
    {
        if (!isset($_POST['email'])) {
            echo 'Email is required';
            return;
        }
        if (!isset($_POST['password'])) {
            echo 'Password is required';
            return;
        }
        $user = new User();
        $data = array(
            'email' => $_POST['email'],
            'password' => md5($_POST['password']),
        );
        $returnedData = $user->get($data, array(), "single");
        if (count($returnedData)) {
            $_SESSION['user_id'] = $returnedData->user_id;
            $_SESSION['admin_email'] = $_POST['email'];
        } else {
            $_SESSION['error'] = "Credential invalid";
            $this->redirect('admin/login');
        }

        //todo: change login landing url
        //$this->redirect('admin');
        $this->redirect('admin/products');

        //echo 'Successfully logged in';
    }

    public function adminLogout()
    {
        //session_destroy();
        unset($_SESSION['customer_id']);
        unset($_SESSION['admin_email']);

        $this->redirect('admin/login');
    }

    public function customerRegister()
    {
        if ($this->isCustomerLoggedIn()) {
            $this->redirect('/');
        }

        $this->view('customers/register');
    }

    public function createAdmin()
    {
        //print_r($_POST);
        $data = array(
            'first_name' => $_POST['first_name'],
            'last_name' => $_POST['last_name'],
            'email' => $_POST['email'],
            'phone' => $_POST['phone'],
            'mobile' => $_POST['mobile'],
            'password' => md5($_POST['password']),
        );
        $user = new User();
        $returned = $user->save($data);
        if ($returned['status'] == 200) {
            echo 'Successfully saved';
        }
        //echo $user->tableName;


    }

    public function createCustomer()
    {
        //echo "<pre>";print_r($_POST);echo "</pre>";return;
        /*if(mail("{$_POST['email']}",'Signup Confirmation','Registration successful.')){
            //echo json_encode(['status' => 200, 'message' => 'Successfully sent']);
        }
        else{
            $_SESSION['error'] = "Email not sent";
            $this->redirect('login');
        }
        exit();*/
        $customerModel = new Customer();

        $customer = $customerModel->getWhere(['email' => $_POST['email']], [], 'single');
        //echo "<pre>";print_r($_POST);echo "</pre>";return;
        if (!empty($customer)) {
            $_SESSION['error'] =  'This Email address has already been taken. Choose another';
            $_SESSION['activeTab'] = 'register';
            $this->redirect('login');
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

            $send_to = array($_POST['email']);
            $username = ucfirst($_POST['first_name']) . ' ' . ucfirst($_POST['last_name']);
            $email = $_POST['email'];
            $mobile = (isset($_POST['mobile']) && !empty($_POST['mobile']))? $_POST['mobile'] : '';
            $subject = 'Signup Confirmation';
            $base_url = DOMAIN.BASE_URL;

            $message = "
                <body style=\"margin: 0;font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif;font-size: 14px;line-height: 1.42857143;color: #333;background-color: #fff;\">
                    <div class=\"container\" style=\"padding-right: 15px; padding-left: 15px; margin-right: auto; margin-left: auto; width:80%;\">
                        <div class=\"effect02\" style=\"background: rgb(0, 0, 0) none repeat scroll 0% 0%; margin-top: 30px; width: 100%; padding: 1px 0px;\">
                            <img src=\"$base_url/assets/customer/img/logo.kpg.png\" alt=\"logo\" style=\"width: 250px; margin: 30px auto; float: none; display: block;\">
                        </div>
                        
                        <div style=\"margin: 0px auto; width: 100%;\">
                            <div style=\"width: 100%;\">
                                <h3 style=\"margin: 30px 0; font-weight: 600; text-align:center;\">Registration successful.</h3>
                
                                <h3 style=\"text-transform: uppercase; font-weight: 600; text-align:center; margin: 10px auto 30px;\">DETAILS</h3>
                
                                <p style=\"margin:5px 0; text-align:center;\"><b>$username</b></p>
                                <p style=\"margin:5px 0; text-align:center;\"><b>$email</b></p>
                                <p style=\"margin:5px 0; text-align:center;\"><b>$mobile</b></p>
                
                                <div  style=\"width: 100%; background:#000; min-height: 30px; margin-top: 30px;\">
                                </div>
                                
                                <div style=\"text-align: center; margin-bottom: 25px; margin-top: 10px; clear: both; width:100%;\">					
                                    <img style=\"width: 100px; margin:0 auto; display: block;\" src=\"$base_url/assets/customer/img/footer-logo.jpg\">
                                    <p style=\"font-size: 13px;margin-top: 3px;margin-bottom: 10px;\">Partner Restaurant</p>
                                    <p><small style=\"\">© 2017 ALL Rights Reserved.</small></p>
                                </div>
                            </div>                
                        </div>
                    </div>
                </body>
            ";

            $send_registration_email = $this->sendEmail('support@madinacharcoalgrill.com', $send_to, $subject, $message);

            if($send_registration_email == 'success'){
                //echo json_encode(['status' => 200, 'message' => 'Successfully sent']);
            }else{
                $_SESSION['error'] = "Email not sent";
                $this->redirect('login');
            }

            $_SESSION['customer_id'] = $customer->getLastInsertedId();
            $_SESSION['customer_email'] = $_POST['email'];
        } else {
            $_SESSION['error'] = "Internal Database error! please try again";
            $_SESSION['activeTab'] = 'register';
            $this->redirect('login');
        }

        $this->redirect('profile');
    }

    public function customerLogin()
    {
        if ($this->isCustomerLoggedIn()) {
            $this->redirect('/');
        }
        $contactsData = $this->getContactInfo();
        $data['contacts'] = $contactsData;

        $data['page'] = 'login';
        $this->view('customer/login', $data);
    }

    public function checkCustomerLogin()
    {
        //echo "<pre>";print_r($_POST);echo "</pre>";return;
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
        //echo "<pre>";print_r($returnedData);echo "</pre>";return;
        if (count($returnedData)) {
            $_SESSION['customer_id'] = $returnedData->customer_id;
            $_SESSION['customer_email'] = $_POST['email'];
        } else {
            $_SESSION['error'] = "Credential invalid";
            $_SESSION['activeTab'] = 'login';
            $this->redirect('login');
        }
        //echo "<pre>";print_r($_SESSION);echo "</pre>";return;

        /*$redirectUrl = $_SESSION['redirect_url'];
        unset($_SESSION['redirect_url']);
        //echo $redirectUrl;exit();
        if (isset($redirectUrl)) {
            $this->redirect($redirectUrl);
        } else {
            $this->redirect('/');
        }*/
        $this->redirect('profile');
    }

    public function customerLogout()
    {
        unset($_SESSION['customer_id']);
        unset($_SESSION['customer_email']);

        $this->redirect('login');
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
}