<?php
namespace App\model;
/**
 * Created by PhpStorm.
 * User: b16030315
 * Date: 1/4/17
 * Time: 6:52 PM
 */
//require_once 'DB.php';

class User extends DB
{
    public $tableName = 'users';

    public function save($data)
    {
        $returned = $this->saveData($this->tableName, $data);
        if ($returned) {
            return ['status' => 200, 'message' => 'Successfully Saved'];
        } else {
            return ['status' => 500, 'message' => 'Internal Server error'];
        }
    }

    public function get($data, $select = array(), $tag = "")
    {
        $returnedData = $this->getValuesAndWhere($this->tableName, $data, $select, $tag);

        return $returnedData;
    }
}