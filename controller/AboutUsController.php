<?php
/**
 * Created by PhpStorm.
 * User: b16030315
 * Date: 1/19/17
 * Time: 12:57 PM
 */

namespace App\controller;
use App\model\AboutUs;


class AboutUsController extends BaseController
{
    public function index()
    {
        $aboutUsModel = new AboutUs();
        $data['aboutUs'] = $aboutUsModel->getWhere(['page_id' => 1], [],'single');
        $this->view('admin/about_us',$data);
        //echo "<pre>"; print_r($data['aboutUs']); echo "</pre>";
    }

    public function createAboutUs()
    {
        //echo "<pre>";var_dump($_POST);echo "</pre>";exit();
        $aboutUsModel = new AboutUs();
        $data = array(
            'content_heading' => $_POST['content_heading'],
            'content' => $_POST['content'],
            'last_updated' => date('Y-m-d')
        );
        $where = ['page_id' => $_POST['page_id']];
        $returnData = $aboutUsModel->update($data, $where);


        if ($returnData['status'] == 200) {
            echo json_encode(['status' => 200, 'message' => $returnData['message'], 'setting_data' => '']);

            return;
        } else {
            echo json_encode(['status' => 500, 'message' => $returnData['message']]);

            return;
        }
    }
}