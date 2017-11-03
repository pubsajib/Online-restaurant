<?php
/**
 * Created by PhpStorm.
 * User: b16030315
 * Date: 1/20/17
 * Time: 4:00 PM
 */

namespace App\model;


class Contact extends BaseModel
{
    public function __construct()
    {
        $this->tableName = 'contacts';
        $this->primaryKey = 'contract_id';
    }
}