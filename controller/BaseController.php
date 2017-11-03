<?php
/**
 * Created by PhpStorm.
 * User: b16030315
 * Date: 1/4/17
 * Time: 5:01 PM
 */
namespace App\controller;

require_once 'config.php';

date_default_timezone_set("Europe/London");

// Report all PHP errors (see changelog)
error_reporting(E_ALL);

/**
 * Class BaseController, every controller needs to be extended by this controller
 *
 * @package Controller\CartController
 */
class BaseController
{
    /**
     * Load the associative view
     *
     * @param string $viewPath, path of the view file
     * @param array $data, data to be loaded in view file
     */
    protected function view($viewPath, $data = [])
    {
        if (!is_array($data)) {
            echo 'Inputted variable should be array';
            return;
        }
        //echo "<pre>";var_dump($data);echo "</pre>";exit();
        if (array_key_exists('BaseController_variable_unique', $data)) {
            echo 'BaseController_variable_unique is unique, choose another variable name';
            return;
        }
        foreach ($data as $key => $BaseController_variable_unique) {
            $$key = $BaseController_variable_unique;
        }
        require_once 'view/'.$viewPath.'.php';
    }

    /**
     * Check if admin is logged in
     *
     * @return bool
     */
    protected function isAdminLoggedIn()
    {
        if (isset($_SESSION['admin_email'])) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Check if customer is logged in
     *
     * @return bool
     */
    protected function isCustomerLoggedIn()
    {
        //echo "<pre>";print_r($_SESSION);echo "</pre>";exit();
        if (isset($_SESSION['customer_email'])) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * To redirect in given url
     *
     * @param string $url
     */
    protected function redirect($url)
    {
        if ($url == '/') {
            $url = BASE_URL;
            echo "<script> window.location.href= '{$url}'</script>";
            exit();
        }
        $url = BASE_URL.'/'.$url;
        echo "<script> window.location.href= '{$url}'</script>";
        exit();
    }

    /**
     * Upload a single image file into given directory
     *
     * @param object $image
     * @param string $targetDir
     * @return array
     */
    protected function uploadImageFile($image, $targetDir)
    {
        $data = [];
        if (isset($image["tmp_name"])) {
            $extension = array("jpeg","jpg","png","gif");
            //$imageNames = array();

            $file_name = $image["name"];
            $file_tmp=$image["tmp_name"];
            //echo $_FILES["images"]["name"][$key];exit();
            $data['originalName'] = time().'_'.basename($image["name"]);
            $targetFile = $targetDir.$data['originalName'];
            //echo $targetFile;exit();
            $ext = pathinfo($file_name, PATHINFO_EXTENSION);
            //var_dump($ext);exit();
            if(in_array($ext, $extension)) {
                //var_dump($_FILES["images"]["tmp_name"][$key]);exit();
                move_uploaded_file($file_tmp, $targetFile);

                $data['status'] = 200;
                $data['message'] = "Image Successfully Uploaded!";
            } else {
                $data['status'] = 500;
                $data['message'] = "$file_name is not an image type file!";
            }
        } else {
            $data['status'] = 500;
            $data['message'] = "No File selected!";
        }

        return $data;
    }

    /**
     * If customer logged in, use this static method anywhere to check if customer logged in
     *
     * @return bool
     */
    public static function isCustomerLogged()
    {
        if (isset($_SESSION['customer_email'])) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Common function for sending email
     *
     * @param string $from
     * @param array $send_to
     * @param string $subject
     * @param string $message
     * @return string
     */
    protected function sendEmail($from, $send_to = array(), $subject, $message){
        // Always set content-type when sending HTML email

        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        // More headers
        $headers .= 'From: Madina Charcoal Grill '.
            'Reply-To: '.$from."\r\n" .
            'X-Mailer: PHP/' . phpversion();
        //$headers .= 'Cc: myboss@example.com' . "\r\n";

        $to = implode(',', $send_to);

        if(mail($to,$subject,$message,$headers)){
            $response = 'success';
        }
        else{
            $response = 'failed';
        }

        return $response;
    }
}