<?php
namespace App\model;
require_once 'config.php';

class DB
{
    public function connect()
    {
        $db = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        //echo "DB_HOST: ".DB_HOST;echo "<br>";echo "DB_USER: ".DB_USER;echo "<br>";echo "DB_PASSWORD: ".DB_PASSWORD;echo "<br>";echo "DB_NAME: ".DB_NAME;echo "<br>";

        if ($db) {
            return $db;
        } else {
            exit("<h2><center><font color='red'>Could not connect database</font></center></h2>");
        }
    }

    public function escape($value){
        return mysqli_real_escape_string($this->connect(),$value);
    }

    /**
     * Save data to table
     *
     * @param $table_name
     * @param $data
     * @return bool
     */
    protected function saveData($table_name, $data)
    {
        $con = $this->connect();
        $sql = "INSERT INTO " . $table_name;
        $prepared_data = (array)$data;
        $fields = "  ";
        foreach ($prepared_data as $key => $value) {
            if ($value != null) {
                $fields .= " $key,";
            }
        }

        $fields = ' (' . rtrim($fields, ',') . ') ';

        $values = "  ";
        foreach ($prepared_data as $key => $value) {
            if ($value != null) {
                $values .= "'" . mysqli_real_escape_string($con, $value) . "',";
            }
        }
        $values = ' (' . rtrim($values, ',') . ') ';
        $sql .= $fields . " VALUES " . $values;
        //echo $sql;exit();
        if (mysqli_query($con, $sql)) {
            mysqli_close($con);
            return true;
        }
        mysqli_close($con);
        return false;
    }

    /**
     * Update data of specific column of specific table
     *
     * @param string $table_name
     * @param array $data
     * @param array $where
     * @return bool
     */
    protected function updateData($table_name, $data, $where)
    {
        $con = $this->connect();
        //echo mysqli_real_escape_string($con, $data['is_active']);exit();
        $sql = "UPDATE " . $table_name;
        $prepared_data = (array)$data;
        $sets  = " SET ";
        foreach ($prepared_data as $key => $value) {
            //if ($value != null) {
                $sets .= " $key = '" . mysqli_real_escape_string($con, $value) . "',";
            //}
        }
        $sets = rtrim($sets, ',');

        $sql .= $sets;
        //echo $sql;exit();

        if ($where != '' && gettype($where) == 'array' && count($where)>0) {
            $where_sql = count($where) > 0 ? ' WHERE ' : '';
            $count = 0;
            foreach ($where as $key => $value) {
                if ($count == 0) {
                    $where_sql .= " $key = '$value' ";
                } else {
                    $where_sql .= " AND $key = '$value' ";
                }
            }
            $sql .= $where_sql;
        } else if ($where != '' && gettype($where) == 'string') {
            $sql .= $where;
        }

        //echo $sql;exit();

        if($where==''){
            return false;
        }else if (mysqli_query($con, $sql)) {
            mysqli_close($con);
            return true;
        }
        mysqli_close($con);
        return false;
    }

    /**
     * @param string $table_name
     * @param array $where
     * @return bool
     */
    protected function deleteData($table_name, $where)
    {
        $con = $this->connect();
        $sql = "DELETE FROM " . $table_name;

        if ($where != '' && gettype($where) == 'array' && count($where)>0) {
            $where_sql = count($where) > 0 ? ' WHERE ' : '';
            $count = 0;
            foreach ($where as $key => $value) {
                if ($count == 0) {
                    $where_sql .= " $key = '$value' ";
                } else {
                    $where_sql .= " AND $key = '$value' ";
                }
            }
            $sql .= $where_sql;
        } else if ($where != '' && gettype($where) == 'string') {
            $sql .= $where;
        }

        //echo $sql;exit();

        if($where==''){
            return false;
        }else if (mysqli_query($con, $sql)) {
            mysqli_close($con);
            return true;
        }
        mysqli_close($con);
        return false;
    }


    public function countRow($table, $where = '')
    {
        $con = $this->connect();
        $sql = "SELECT COUNT(*) AS count FROM $table ";
        if ($where != '' && gettype($where) == 'array' && count($where)>0) {
            $where_sql = '';
            $where_sql = count($where) > 0 ? ' WHERE ' : '';
            $count = 0;
            //print_r($where);exit();
            foreach ($where as $key => $value) {
                if ($count == 0) {
                    $where_sql .= " $key = '$value' ";
                } else {
                    $where_sql .= " AND $key = '$value' ";
                }
            }
            $sql .= $where_sql;
        } else if ($where != '' && gettype($where) == 'string') {
            $sql .= $where;
        }

        //echo $sql;exit();

        $query_sql = mysqli_query($con, $sql);
        //echo $querySql;exit();

        $result = NULL;
        while ($data = mysqli_fetch_object($query_sql)) {
            $result = $data->count;
        }
        return $result;
    }


    protected function execute($query)
    {

        $con = $this->connect();

        if (mysqli_query($con, $query)) {

            mysqli_close($con);

            return true;

        }

        //$error =  mysqli_error ($con);

        mysqli_close($con);

        return false;

    }

    /**
     * Get all row in a table
     *
     * @param $tableName
     * @return array|null|object|string
     */
    protected function all($tableName)
    {
        $sql = "select * from {$tableName}";
        $data = $this->select($sql);

        return $data;
    }

    /**
     * Get first row in a table
     *
     * @param $tableName
     * @return array|null|object|string
     */
    protected function first($tableName)
    {
        $sql = "select * from {$tableName}";
        $data = $this->select($sql,'single');

        return $data;
    }

    /**
     * Get values with and where query
     *
     * @param $table
     * @param $data
     * @param array $select
     * @param string $tag
     * @return array|null|object|string|void
     */
    protected function getValuesAndWhere($table, $data, $select = array(), $tag = "")
    {
        //$sql = "Select"
        $selectKeys = '*';
        if (!empty($select)) {
            if (!is_array($select)) {
                echo "Select keys should be an array";
                return;
            }
            $selectKeys = '';
            foreach ($select as $item) {
                $selectKeys = $selectKeys.$item.',';
            }

            $selectKeys = rtrim($selectKeys, ',');
        }

        $sql = "select {$selectKeys} from {$table} where";
        $where = '';
        if (!empty($data)) {
            if (!is_array($data)) {
                echo "Column should be in key => value pair";
                return;
            }

            foreach ($data as $key => $val) {
                $where .= " {$key} = '{$val}' and";
            }

            $where = rtrim($where, ' and');
        }

        $sql = $sql.$where;
        //echo $sql;exit();
        $selectedValue = $this->select($sql, $tag);
        //var_dump($selectedValue);exit();

        return $selectedValue;
    }

    /**
     * Execution of select query
     *
     * @param $query
     * @param string $tag
     * @return array|null|object|string
     */
    protected function select($query, $tag = "")
    {

        $con = $this->connect();

        $a = "";

        $sql = mysqli_query($con, $query);

        if ($tag == "array") {

            while ($data = mysqli_fetch_assoc($sql)) {

                $a[] = $data;

            }

        } else if ($tag == "single") {

            $a = mysqli_fetch_object($sql);

        } else {

            while ($data = mysqli_fetch_object($sql)) {

                $a[] = $data;

            }

        }

        mysqli_close($con);

        return $a;

    }


    protected function count_rows($query)
    {

        $count = 0;

        $con = $this->connect();

        $sql = mysqli_query($con, $query);

        while ($data = mysqli_fetch_row($sql)) {

            $count = $data[0];

        }

        return $count;

    }

    /**
     * Get the last inserted Id
     *
     * @param $table
     * @param $primary_key
     * @return string, last id
     */
    protected function getMaxId($table,$primary_key){
        $con = $this->connect();
        $sql = "SELECT MAX($primary_key) AS max_id FROM $table ";
        $query_sql = mysqli_query($con, $sql);
        $result = NULL;
        while ($data = mysqli_fetch_object($query_sql)) {
            $result = $data->max_id;
        }
        return $result;
    }



}

