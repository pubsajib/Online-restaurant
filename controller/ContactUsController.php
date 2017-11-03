<?php
/**
 * Created by PhpStorm.
 * User: b16030315
 * Date: 1/19/17
 * Time: 12:58 PM
 */

namespace App\controller;
use App\model\Contact;


class ContactUsController extends BaseController
{
    public function index()
    {
        $contactsData = $this->getContactInfo();
        $data['contacts'] = $contactsData;
        $this->view('admin/contact_us',$data);
        //echo "<pre>"; print_r($data['contacts']); echo "</pre>";
    }

    public function createContactDetails()
    {
        $contactModel = new Contact();
        $contacts = $contactModel->getFirst();

        $emails = array(
            'header_email1' => $_POST['header_email1'],
            'reservation_email1' => $_POST['reservation_email1'],
            'contact_email1' => $_POST['contact_email1'],
            'contact_email2' => $_POST['contact_email2'],
            'query_email1' => $_POST['query_email1']
        );
        $street = array(
            'header_street' => '',
            'reservation_street' => '',
            'contact_street' => $_POST['contact_street'],
            'query_street' => '',
        );
        $city = array(
            'header_city' => '',
            'reservation_city' => '',
            'contact_city' => $_POST['contact_city'],
            'query_city' => ''
        );
        $post_code = array(
            'header_postcode' => '',
            'reservation_postcode' => '',
            'contact_postcode' => $_POST['contact_postcode'],
            'query_postcode' => '',
        );
        $phone = array(
            'header_phone1' => $_POST['header_phone1'],
            'reservation_phone1' => $_POST['reservation_phone1'],
            'contact_phone1' => $_POST['contact_phone1'],
            'contact_phone2' => $_POST['contact_phone2'],
            'query_phone1' => ''
        );

        $data = array(
            'email'                    => json_encode($emails),
            'contact_address_street'   => json_encode($street),
            'contact_address_city'     => json_encode($city),
            'contact_address_postcode' => json_encode($post_code),
            'phone'                    => json_encode($phone),
            'company_name'             => $_POST['company_name'],
        );
        $where = ['contract_id' => $contacts->contract_id];
        $returnData = $contactModel->update($data, $where);


        if ($returnData['status'] == 200) {
            echo json_encode(['status' => 200, 'message' => $returnData['message'], 'setting_data' => '']);

            return;
        } else {
            echo json_encode(['status' => 500, 'message' => $returnData['message']]);

            return;
        }
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
        $contactsData['company_name'] = $contacts->company_name;

        return $contactsData;
    }
}