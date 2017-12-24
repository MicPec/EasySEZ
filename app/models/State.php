<?php

namespace app\models;

use mako\database\midgard\ORM;
use mako\database\midgard\traits\ReadOnlyTrait;

class State extends ORM
{
    use ReadOnlyTrait;
    protected $tableName = 'state';
    protected $including = ['statuses'];

    public function statuses()
    {
        return $this->hasMany(Status::class);
    }

    public function searchScope($query, $s)
    {
        return $query->where('name', 'LIKE', "%$s%");
    }
}
