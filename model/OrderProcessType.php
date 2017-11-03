<?php
/**
 * Created by PhpStorm.
 * User: b16030315
 * Date: 1/13/17
 * Time: 11:23 AM
 */

namespace App\model;


class OrderProcessType extends DB
{
    public $tableName = 'order_process_type';

    public function getAll()
    {
        $data = $this->all($this->tableName);

        return $data;
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