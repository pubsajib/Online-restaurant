<?php
namespace App\model;
//require_once 'DB.php';
/**
 * Created by PhpStorm.
 * User: b16030315
 * Date: 1/6/17
 * Time: 5:31 PM
 */
class productExtra extends DB
{
    public $tableName = 'product_extra';

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

    /**
     * This is base model method, as base model is not extended here so it's a copy of that method
     *
     * @param array $joinTables, name of all table to be joined with constraint
     * @param array $data where conditions in key value pair
     * @return array|null|object|string|void
     */
    public function getJoinedData($joinTables, $data = array())
    {
        $sql = "select *  from {$this->tableName}";
        foreach ($joinTables as $joinTable) {
            $sql = $sql." join {$joinTable['tableName']} on {$joinTable['tableName']}.{$joinTable['constraintKey']} = {$this->tableName}.{$joinTable['constraintKey']}";
        }
        $where = ' where';
        if (!empty($data)) {
            if (!is_array($data)) {
                echo "Column should be in key => value pair";
                return;
            }

            foreach ($data as $key => $val) {
                $where .= " {$this->tableName}.{$key} = '{$val}' and";
            }

            $where = rtrim($where, ' and');
            $sql = $sql.$where;
        }
        //echo $sql;exit();
        $data = $this->select($sql);

        return $data;
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

    public function getProductRealtedExtra($productID)
    {
        $sql = "select *  from product_extra where product_id = $productID and is_active = 'Active' order by extra_id asc;";
        $data = $this->select($sql);

        return $data;
    }
}