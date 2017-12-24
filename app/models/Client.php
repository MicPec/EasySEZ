<?php

namespace app\models;

use mako\database\midgard\ORM;
use mako\database\query\Raw;

class Client extends ORM
{
    protected $tableName = 'client';
    protected $assignable = ['company', 'fname', 'sname', 'email', 'phone', 'company', 'website'];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function ordersCountScope($query)
    {
        return $query->select(['*', new Raw('(select count(`order`.`id`) from `order` where `order`.`client_id` = `client`.`id` group by `order`.`client_id`) AS `ordersCount`')]);
    }

    public function searchScope($query, $s)
    {
        return $query->where('fname', 'LIKE', "%$s%")->orWhere('sname', 'LIKE', "%$s%")->orWhere('company', 'LIKE', "%$s%")->orWhere('email', 'LIKE', "%$s%")->orWhere('website', 'LIKE', "%$s%")->orWhere('phone', 'LIKE', "%$s%");
    }
}
