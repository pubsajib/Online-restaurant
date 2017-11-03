<?php
namespace App\controller;
/**
 * Created by PhpStorm.
 * User: b16030315
 * Date: 1/4/17
 * Time: 6:28 PM
 */
require_once 'BaseController.php';
require_once 'model/User.php';
require_once 'model/Customer.php';

class SettingsController extends BaseController
{
    public function openingClosingTime()
    {
        $this->view('admin/opening_closing_time');
    }
	
	public function deliveryCharge()
    {
        $this->view('admin/delivery_charge');
    }
	
	public function deliveryMinimum()
    {
        $this->view('admin/delivery_minimum');
    }

    public function deliveryAndCollection()
    {
        $this->view('admin/delivery_collection');
    }

    public function paymentOption()
    {
        $this->view('admin/payment_option');
    }

    public function bannerInfo()
    {
        $this->view('admin/banner_info');
    }

    public function deliveryTime()
    {
        $this->view('admin/delivery_time');
    }
}
