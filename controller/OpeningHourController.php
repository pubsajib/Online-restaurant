<?php
namespace App\controller;
use App\model\OpeningHour;

require_once "BaseController.php";
require_once "model/OpeningHour.php";
/**
 * Created by PhpStorm.
 * User: b16030315
 * Date: 1/10/17
 * Time: 6:24 PM
 */
class OpeningHourController extends BaseController
{
    public function openingHour()
    {
        if (!$this->isAdminLoggedIn()) {
            $this->redirect('admin/login');
        }

        $openingHourModel = new OpeningHour();
        $data['deliveryTime'] = $openingHourModel->getFirst();
        $this->view('admin/opening_closing_time', $data);
        //echo "<pre>"; print_r($data['deliveryTime']); echo "</pre>";
    }

    public function updateOpeningHour()
    {
        if (!$this->isAdminLoggedIn()) {
            $this->redirect('admin/login');
        }

        $openingHourModel = new OpeningHour();
        $openingHour = $openingHourModel->getFirst();
        $switch_check = $_POST['switch_check'];
        $sunday_start_time = $_POST['sun_start_time'];
        $sunday_end_time = $_POST['sun_end_time'];
        $monday_start_time = $_POST['mon_start_time'];
        $monday_end_time = $_POST['mon_end_time'];
        $tuesday_start_time = $_POST['tue_start_time'];
        $tuesday_end_time = $_POST['tue_end_time'];
        $wednesday_start_time = $_POST['wed_start_time'];
        $wednesday_end_time = $_POST['wed_end_time'];
        $thursday_start_time = $_POST['thu_start_time'];
        $thursday_end_time = $_POST['thu_end_time'];
        $friday_start_time = $_POST['fri_start_time'];
        $friday_end_time = $_POST['fri_end_time'];
        $saturday_start_time = $_POST['sat_start_time'];
        $saturday_end_time = $_POST['sat_end_time'];
        $day_name = $_POST['day_name'];

        $data = array();
        foreach($switch_check as $key=>$value){
            $open_array = array();
            if($switch_check[$key]==0){ // if off
                $open_array['is_open'] = 0;
                $open_array['times'][0] = array('start_time'=>'24 hours', 'end_time'=>'11:00 pm');
                $jsonData = json_encode($open_array);
            }
            else{
                $open_array['is_open'] = 1;
                $open_array['times'] = array();
                $value = $day_name[$key];
                if($value=='sunday'){
                    $start_time = $sunday_start_time;
                    $end_time = $sunday_end_time;
                }
                else if($value=='monday'){
                    $start_time = $monday_start_time;
                    $end_time = $monday_end_time;
                }
                else if($value=='tuesday'){
                    $start_time = $tuesday_start_time;
                    $end_time = $tuesday_end_time;
                }
                else if($value=='wednesday'){
                    $start_time = $wednesday_start_time;
                    $end_time = $wednesday_end_time;
                }
                else if($value=='thursday'){
                    $start_time = $thursday_start_time;
                    $end_time = $thursday_end_time;
                }
                else if($value=='friday'){
                    $start_time = $friday_start_time;
                    $end_time = $friday_end_time;
                }
                else if($value=='saturday'){
                    $start_time = $saturday_start_time;
                    $end_time = $saturday_end_time;
                }
                $times_array = array();
                foreach($start_time as $start_key=>$start_value){
                    $times_array = array('start_time'=>$start_time[$start_key], 'end_time'=>$end_time[$start_key]);
                    array_push($open_array['times'],$times_array);
                }
                $jsonData = json_encode($open_array);
            }
            $data[$day_name[$key]] = $jsonData;
        }
        $data['updated_by'] = $_SESSION['user_id'];
        $data['last_update'] = date('Y-m-d h:i:s');

        if(empty($openingHour)){
            $returnData = $openingHourModel->save($data);
        }
        else{
            $where = ['opening_hours_id' => $openingHour->opening_hours_id];
            $returnData = $openingHourModel->update($data, $where);
        }


        if ($returnData['status'] == 200) {
            echo json_encode(['status' => 200, 'message' => $returnData['message'], 'setting_data' => '']);

            return;
        } else {
            echo json_encode(['status' => 500, 'message' => $returnData['message']]);

            return;
        }
    }



}