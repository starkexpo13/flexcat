<?php


namespace admin\Test\Model;

use Engine\Model\Model;

class TestRepository extends Model
{
    protected $table = 'onlinetests';
    protected $orderList = 'title';
}