<?php
namespace App\controller;
use App\model\Settings;

require_once "BaseController.php";
require_once "model/Settings.php";
/**
 * Created by PhpStorm.
 * User: b16030315
 * Date: 1/10/17
 * Time: 6:24 PM
 */
class DeliveryChargeController extends BaseController
{
    public function deliveryCharge()
    {
        $settingsModel = new Settings();
        $data['deliveryCharge'] = $settingsModel->getFirst();
        $this->view('admin/delivery_charge', $data);
    }

    public function createDeliveryCharge()
    {
        //echo "<pre>";var_dump($_POST);echo "</pre>";exit();
        $settingsModel = new Settings();
        $settingData = $settingsModel->getFirst();
        if(empty($settingData)){
            $data = array(
                'delivery_charge' => $_POST['delivery_charge'],
            );
            $returnData = $settingsModel->save($data);
        }
        else{
            $data = array(
                'delivery_charge' => $_POST['delivery_charge'],
                'delivery_minimum' => $settingData->delivery_minimum,
                'estimated_collection_time' => $settingData->estimated_collection_time
            );
            $where = ['settings_id' => $settingData->settings_id];
            $returnData = $settingsModel->update($data, $where);
        }


        if ($returnData['status'] == 200) {
            $settingData = $settingsModel->getFirst();
            echo json_encode(['status' => 200, 'message' => $returnData['message'], 'setting_data' => $settingData]);

            return;
        } else {
            echo json_encode(['status' => 500, 'message' => $returnData['message']]);

            return;
        }
    }

    public function deleteDeliveryCharge()
    {
        //echo "<pre>";var_dump($_POST);echo "</pre>";exit();
        $settingsModel = new Settings();
        $settingData = $settingsModel->getFirst();
        if(empty($settingData)){
            echo json_encode(['status' => 500, 'message' => 'No data found to delete']);
            return;
        }
        else{
            $data = array(
                'delivery_charge' => '',
                'delivery_minimum' => $settingData->delivery_minimum,
                'estimated_collection_time' => $settingData->estimated_collection_time
            );
            $where = ['settings_id' => $settingData->settings_id];
            $returnData = $settingsModel->update($data, $where);
        }


        if ($returnData['status'] == 200) {
            echo json_encode(['status' => 200, 'message' => 'Successfully deleted', 'setting_data' => '']);

            return;
        } else {
            echo json_encode(['status' => 500, 'message' => $returnData['message']]);

            return;
        }
    }


    public function deliveryMinimum()
    {
        $settingsModel = new Settings();
        $data['deliveryMinimum'] = $settingsModel->getFirst();
        $this->view('admin/delivery_minimum', $data);
    }

    public function createDeliveryMinimum(){
        //echo "<pre>";var_dump($_POST);echo "</pre>";exit();
        $settingsModel = new Settings();
        $settingData = $settingsModel->getFirst();
        if(empty($settingData)){
            $data = array(
                'delivery_minimum' => $_POST['delivery_minimum'],
            );
            $returnData = $settingsModel->save($data);
        }
        else{
            $data = array(
                'delivery_charge' => $settingData->delivery_charge,
                'delivery_minimum' => $_POST['delivery_minimum'],
                'estimated_collection_time' => $settingData->estimated_collection_time
            );
            $where = ['settings_id' => $settingData->settings_id];
            $returnData = $settingsModel->update($data, $where);
        }


        if ($returnData['status'] == 200) {
            $settingData = $settingsModel->getFirst();
            echo json_encode(['status' => 200, 'message' => $returnData['message'], 'setting_data' => $settingData]);

            return;
        } else {
            echo json_encode(['status' => 500, 'message' => $returnData['message']]);

            return;
        }
    }

    public function deleteDeliveryMinimum(){
        $settingsModel = new Settings();
        $settingData = $settingsModel->getFirst();
        if(empty($settingData)){
            echo json_encode(['status' => 500, 'message' => 'No data found to delete']);
            return;
        }
        else{
            $data = array(
                'delivery_charge' => $settingData->delivery_charge,
                'delivery_minimum' => '',
                'estimated_collection_time' => $settingData->estimated_collection_time
            );
            $where = ['settings_id' => $settingData->settings_id];
            $returnData = $settingsModel->update($data, $where);
        }


        if ($returnData['status'] == 200) {
            $settingData = $settingsModel->getFirst();
            echo json_encode(['status' => 200, 'message' => $returnData['message'], 'setting_data' => $settingData]);

            return;
        } else {
            echo json_encode(['status' => 500, 'message' => $returnData['message']]);

            return;
        }
    }

}