<?php
/**
 * Created by PhpStorm.
 * User: b16030315
 * Date: 1/20/17
 * Time: 4:09 PM
 */

namespace App\model;


class BaseModel extends DB
{
    protected $tableName = '';
    protected $primaryKey = '';

    public function getAll()
    {
        $data = $this->all($this->tableName);

        return $data;
    }

    public function getFirst()
    {
        $data = $this->first($this->tableName);

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

    public function getLastInsertedId()
    {
        $returnData = $this->getMaxId($this->tableName, $this->primaryKey);

        return $returnData;
    }

    /**
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