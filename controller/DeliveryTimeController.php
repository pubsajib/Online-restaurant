<?php
namespace App\controller;
use App\model\DeliveryTime;
use App\model\Settings;

require_once "BaseController.php";
require_once "model/DeliveryTime.php";
/**
 * Created by PhpStorm.
 * User: b16030315
 * Date: 1/10/17
 * Time: 6:24 PM
 */
class DeliveryTimeController extends BaseController
{
    public function deliveryTime()
    {
        $settingsModel = new Settings();
        $data['estimatedDeliveryTime'] = $settingsModel->getFirst();
        $this->view('admin/delivery_time', $data);
    }

    public function createDeliveryTime()
    {
        $settingsModel = new Settings();
        $settingData = $settingsModel->getFirst();
        if(empty($settingData)){
            $data = array(
                'estimated_collection_time' => $_POST['delivery_time']
            );
            $returnData = $settingsModel->save($data);
        }
        else{
            $data = array(
                'delivery_charge' => $settingData->delivery_charge,
                'delivery_minimum' => $settingData->delivery_minimum,
                'estimated_collection_time' => $_POST['delivery_collection'],
                'estimated_delivery_time' => $_POST['delivery_time']
            );
            $where = ['settings_id' => $settingData->settings_id];
            $returnData = $settingsModel->update($data, $where);
        }


        if ($returnData['status'] == 200) {
            echo json_encode(['status' => 200, 'message' => $returnData['message'], 'setting_data' => '']);

            return;
        } else {
            echo json_encode(['status' => 500, 'message' => $returnData['message']]);

            return;
        }
    }

    public function deleteDeliveryMinimum()
    {
        $settingsModel = new Settings();
        $settingData = $settingsModel->getFirst();
        if(empty($settingData)){
            echo json_encode(['status' => 500, 'message' => 'No data found to delete']);
            return;
        }
        else{
            $data = array(
                'delivery_charge' => $settingData->delivery_charge,
                'delivery_minimum' => $settingData->delivery_minimum,
                'estimated_collection_time' => ''
            );
            $where = ['settings_id' => $settingData->settings_id];
            $returnData = $settingsModel->update($data, $where);
        }


        if ($returnData['status'] == 200) {
            echo json_encode(['status' => 200, 'message' => 'Delivery time successfully removed', 'setting_data' => '']);

            return;
        } else {
            echo json_encode(['status' => 500, 'message' => $returnData['message']]);

            return;
        }
    }



}