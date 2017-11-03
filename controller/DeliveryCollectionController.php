<?php
namespace App\controller;
use App\model\DeliveryCollection;

require_once "BaseController.php";
require_once "model/DeliveryCollection.php";
/**
 * Created by PhpStorm.
 * User: b16030315
 * Date: 1/10/17
 * Time: 6:24 PM
 */
class DeliveryCollectionController extends BaseController
{
    public function deliveryCollection()
    {
        $deliveryCollectionModel = new DeliveryCollection();
        $data['deliveryCollection'] = $deliveryCollectionModel->getAll();
        $this->view('admin/delivery_collection', $data);
    }

    public function createDeliveryCollection()
    {
        $deliveryCollectionModel = new DeliveryCollection();
        $collectionData = $deliveryCollectionModel->getFirst();

        if(isset($_POST['Delivery'])){
            $data['is_active'] = 1;
        }
        else{
            $data['is_active'] = 0;
        }
        $where = ['order_process_name' => 'Delivery'];
        $returnData = $deliveryCollectionModel->update($data, $where);

        if(isset($_POST['Collection'])){
            $data['is_active'] = 1;
        }
        else{
            $data['is_active'] = 0;
        }
        $where = ['order_process_name' => 'Collection'];
        $returnData = $deliveryCollectionModel->update($data, $where);

        if ($returnData['status'] == 200) {
            echo json_encode(['status' => 200, 'message' => $returnData['message'], 'setting_data' => '']);

            return;
        } else {
            echo json_encode(['status' => 500, 'message' => $returnData['message']]);

            return;
        }
    }



}