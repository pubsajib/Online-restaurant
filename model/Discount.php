<?php
/**
 * Created by PhpStorm.
 * User: b16030315
 * Date: 1/20/17
 * Time: 4:00 PM
 */

namespace App\model;


class Discount extends BaseModel
{
    public function __construct()
    {
        $this->tableName = 'discounts';
        $this->primaryKey = 'discount_id';
    }
}