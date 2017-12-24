<?php

namespace app\models;

use mako\database\midgard\ORM;
use mako\database\query\Raw;

class Product extends ORM
{
    protected $tableName = 'product';
    protected $assignable = ['name', 'unit_id', 'unitprice'];
    protected $including = ['unit'];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function ordersCountScope($query)
    {
        return $query->select(['*', new Raw('(select count(`order`.`id`) from `order` where `order`.`product_id` = `product`.`id` group by `order`.`product_id`) AS `ordersCount`')]);
    }

    public function searchScope($query, $s)
    {
        return $query->where('name', 'LIKE', "%$s%");
    }
}
