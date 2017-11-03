<?php
namespace App\controller;
/**
 * Created by PhpStorm.
 * User: b16030315
 * Date: 1/4/17
 * Time: 3:57 PM
 */
require_once 'BaseController.php';

class HomeController extends BaseController
{
    function index () {
        if (!$this->isAdminLoggedIn()) {
            $this->redirect('admin/login');
        }

        $this->view('admin/home');
    }

    function admin () {
        echo 'go to admin';
    }

}