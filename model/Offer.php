<?php
/**
 * Created by PhpStorm.
 * User: b16030315
 * Date: 1/20/17
 * Time: 4:00 PM
 */

namespace App\model;


class Offer extends BaseModel
{
    public function __construct()
    {
        $this->tableName = 'offer';
        $this->primaryKey = 'offer_id';
    }
}