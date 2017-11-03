<?php
namespace App\controller;
use App\model\PaymentOption;

require_once "BaseController.php";
require_once "model/PaymentOption.php";
/**
 * Created by PhpStorm.
 * User: b16030315
 * Date: 1/10/17
 * Time: 6:24 PM
 */
class PaymentOptionController extends BaseController
{
    public function paymentOption()
    {
        $paymentOptionModel = new PaymentOption();
        $data['paymentOptions'] = $paymentOptionModel->getAll();
        $this->view('admin/payment_option', $data);
    }

    public function createPaymentOption()
    {
        $paymentOptionModel = new PaymentOption();
        if(isset($_POST['Cash'])){
            $data['is_active'] = 1;
        }
        else{
            $data['is_active'] = 0;
        }
        $where = ['payment_type_name' => 'Cash'];
        $returnData = $paymentOptionModel->update($data, $where);

        if(isset($_POST['Card'])){
            $data['is_active'] = 1;
        }
        else{
            $data['is_active'] = 0;
        }
        $where = ['payment_type_name' => 'Card'];
        $returnData = $paymentOptionModel->update($data, $where);


        if ($returnData['status'] == 200) {
            echo json_encode(['status' => 200, 'message' => $returnData['message'], 'setting_data' => '']);

            return;
        } else {
            echo json_encode(['status' => 500, 'message' => $returnData['message']]);

            return;
        }
    }

}