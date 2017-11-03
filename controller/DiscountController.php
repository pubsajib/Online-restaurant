<?php
/**
 * Created by PhpStorm.
 * User: b16030315
 * Date: 1/19/17
 * Time: 12:58 PM
 */

namespace App\controller;
use App\model\Contact;
use App\model\Discount;


class DiscountController extends BaseController
{
    public function index()
    {
        $discountModel = new Discount();
        $discountData = $discountModel->getFirst();
        $data['discounts'] = $discountData;
        $this->view('admin/discount_info',$data);
        //echo "<pre>"; print_r($data['discounts']); echo "</pre>";
    }

    public function createDiscountDetails()
    {
        $discountModel = new Discount();
        $discounts = $discountModel->getFirst();

        $data = array(
            'discount_type' => $_POST['discount_type'],
            'min_amount'    => $_POST['minimum_amount'],
            'max_amount'    => $_POST['maximum_amount'],
            'discount_rate' => $_POST['discount_rate'],
        );
        $where = ['discount_id' => $discounts->discount_id];
        $returnData = $discountModel->update($data, $where);


        if ($returnData['status'] == 200) {
            echo json_encode(['status' => 200, 'message' => $returnData['message'], 'setting_data' => '']);

            return;
        } else {
            echo json_encode(['status' => 500, 'message' => $returnData['message']]);

            return;
        }
    }
}