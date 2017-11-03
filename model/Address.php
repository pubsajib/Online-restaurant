<?php
/**
 * Created by PhpStorm.
 * User: b16030315
 * Date: 1/20/17
 * Time: 5:51 PM
 */

namespace App\model;


class Address extends BaseModel
{
    public function __construct()
    {
        $this->tableName = 'address';
        $this->primaryKey = 'address_id';
    }
}