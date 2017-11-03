<?php
namespace App\model;
require_once 'DB.php';

/**
 * Created by PhpStorm.
 * User: b16030315
 * Date: 1/6/17
 * Time: 5:42 PM
 */
class Category extends DB
{
    public $tableName = 'categories';

    public function getAll()
    {
        $data = $this->all($this->tableName);

        return $data;
    }

    public function getWhere($data, $select = array(), $tag = "")
    {
        $returnedData = $this->getValuesAndWhere($this->tableName, $data, $select, $tag);

        return $returnedData;
    }

    public function save($data)
    {
        $returned = $this->saveData($this->tableName, $data);
        //var_dump($returned);exit();

        if ($returned) {
            return ['status' => 200, 'message' => 'Successfully Saved'];
        } else {
            return ['status' => 500, 'message' => 'Internal Server error'];
        }
    }

    /**
     * @param array $data
     * @param array $where
     * @return array
     */
    public function update($data, $where)
    {
        $returned = $this->updateData($this->tableName, $data, $where);
        //var_dump($returned);exit();

        if ($returned) {
            return ['status' => 200, 'message' => 'Successfully Saved'];
        } else {
            return ['status' => 500, 'message' => 'Internal Server error'];
        }
    }

    /**
     * @param array $where
     * @return array
     */
    public function delete($where)
    {
        $returned = $this->deleteData($this->tableName, $where);

        if ($returned) {
            return ['status' => 200, 'message' => 'Successfully Deleted'];
        } else {
            return ['status' => 500, 'message' => 'Internal Server error'];
        }
    }


    /**
     * Get the raw query
     *
     * @param $sql
     * @return array|null|object|string
     */
    public function getRaw($sql)
    {
        $data = $this->select($sql);

        return $data;
    }
}