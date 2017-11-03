<?php
/**
 * Created by PhpStorm.
 * User: b16030315
 * Date: 1/20/17
 * Time: 4:00 PM
 */

namespace App\model;


class Customer extends BaseModel
{
    public function __construct()
    {
        $this->tableName = 'customers';
        $this->primaryKey = 'customer_id';
    }

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

    public function getWhere($data, $select = array(), $tag = "")
    {
        $returnedData = $this->getValuesAndWhere($this->tableName, $data, $select, $tag);

        return $returnedData;
    }
}