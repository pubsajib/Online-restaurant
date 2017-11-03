<?php
/**
 * Created by PhpStorm.
 * User: b16030315
 * Date: 1/20/17
 * Time: 4:00 PM
 */

namespace App\model;


class AboutUs extends BaseModel
{
    public function __construct()
    {
        $this->tableName = 'pages';
        $this->primaryKey = 'page_id';
    }
}