<?php
/**
 * Created by PhpStorm.
 * User: b16030315
 * Date: 1/19/17
 * Time: 12:57 PM
 */

namespace App\controller;
use App\model\Settings;


class BannerController extends BaseController
{
    public function index()
    {
        $settingsModel = new Settings();
        $data['bannerData'] = $settingsModel->getFirst();
        $this->view('admin/banner',$data);
        //echo "<pre>"; print_r($data['bannerData']); echo "</pre>";
    }

    public function createBannerDetails()
    {
        $settingsModel = new Settings();
        $bannerData = $settingsModel->getFirst();
        $banner = json_decode($bannerData->banner,true);
        $banner['home_banner_text'] = $_POST['banner_text'];
        $data = array(
            'banner' => json_encode($banner)
        );
        $where = ['settings_id' => $bannerData->settings_id];
        $returnData = $settingsModel->update($data, $where);


        if ($returnData['status'] == 200) {
            echo json_encode(['status' => 200, 'message' => $returnData['message'], 'setting_data' => '']);

            return;
        } else {
            echo json_encode(['status' => 500, 'message' => $returnData['message']]);

            return;
        }
    }
}