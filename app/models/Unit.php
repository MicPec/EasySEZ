<?php

namespace app\models;

use mako\database\midgard\ORM;

class Unit extends ORM
{
    protected $tableName = 'unit';
    protected $assignable = ['name'];

    public function searchScope($query, $s)
    {
        return $query->where('name', 'LIKE', "%$s%");
    }
}
