<?php
/**
 * Created by PhpStorm.
 * User: b16030315
 * Date: 1/30/17
 * Time: 12:08 PM
 */

namespace App\controller;

use App\model\Contact;
use App\model\OpeningHour;

/**
 * Class CommonController
 * @package App\controller
 */
class CommonController extends BaseController
{
    public function commonErrorMessage()
    {
        $contactsData = $this->getContactInfo();
        $data['contacts'] = $contactsData;
        $data['errorMessage'] = '';
        if (isset($_SESSION['errorMsg'])) {
            $data['errorMessage'] = $_SESSION['errorMsg'];
            unset($_SESSION['errorMsg']);
        }
        $this->view('customer/messages', $data);
    }

    private function getContactInfo()
    {
        $contactModel = new Contact();
        $contacts = $contactModel->getFirst();
        $contactsData = array();

        $emailData = json_decode($contacts->email,true);
        $contactsData = array_merge($contactsData, $emailData);

        $streetData = json_decode($contacts->contact_address_street,true);
        $contactsData = array_merge($contactsData, $streetData);

        $cityData = json_decode($contacts->contact_address_city,true);
        $contactsData = array_merge($contactsData, $cityData);

        $postcodeData = json_decode($contacts->contact_address_postcode,true);
        $contactsData = array_merge($contactsData, $postcodeData);

        $phoneData = json_decode($contacts->phone,true);
        $contactsData = array_merge($contactsData, $phoneData);

        $openingHourModel = new OpeningHour();
        $openingHours = $openingHourModel->getFirst();
        $contactsData['opening_times'] = $this->formatOpeningHours($openingHours);
        $currentDay = date("l");
        $currentDay = strtolower($currentDay);
        $contactsData['current_opening_time'] = json_decode($openingHours->{$currentDay},true);

        return $contactsData;
    }

    private function formatOpeningHours($openingHours)
    {
        $opening_hours = array();
        foreach($openingHours as $Key=>$value){
            $opening_hours[$Key] = json_decode($value,true);
        }
        return $opening_hours;
    }
}