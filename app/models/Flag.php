<?php

namespace app\models;

use mako\database\midgard\ORM;

class Flag extends ORM
{
    protected $tableName = 'flag';
    protected $assignable = ['name', 'color'];

    public function orders()
    {
        return $this->manyToMany(Order::class, 'flag_id', 'order_flags');
    }

    public function searchScope($query, $s)
    {
        return $query->where('name', 'LIKE', "%$s%");
    }
}
