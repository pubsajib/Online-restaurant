<?php
namespace App\controller;
use App\model\Postcode;

require_once "BaseController.php";
require_once "model/Postcode.php";
/**
 * Created by PhpStorm.
 * User: b16030315
 * Date: 1/10/17
 * Time: 6:24 PM
 */
class PostcodeController extends BaseController
{
    public function postcode()
    {
        $postcodeModel = new Postcode();
        $data['postcodes'] = $postcodeModel->getAll();
        $this->view('admin/post_code', $data);
    }

    public function createPostcode()
    {
        //echo "<pre>";var_dump($_POST);echo "</pre>";exit();
        $postcodeModel = new Postcode();
        $data = array(
            'postcode_no' => $_POST['postcode_no'],
        );

        if (isset($_POST['postcode_id'])) {
            $where = ['postcode_id' => $_POST['postcode_id']];
            $returnData = $postcodeModel->update($data, $where);
        } else {
            $returnData = $postcodeModel->save($data);
        }

        if ($returnData['status'] == 200) {
            $postcodes = $postcodeModel->getAll();
            echo json_encode(['status' => 200, 'message' => $returnData['message'], 'postcodes' => $postcodes]);

            return;
        } else {
            echo json_encode(['status' => 500, 'message' => $returnData['message']]);

            return;
        }
    }

    public function deletePostcode()
    {
        $postcodeModel = new Postcode();
        $where = ['postcode_id' => $_POST['postcode_id']];
        $returnData = $postcodeModel->delete($where);

        if ($returnData['status'] == 200) {
            $postcodes = $postcodeModel->getAll();
            echo json_encode(['status' => 200, 'message' => $returnData['message'], 'postcodes' => $postcodes]);

            return;
        } else {
            echo json_encode(['status' => 500, 'message' => $returnData['message']]);

            return;
        }
    }
}