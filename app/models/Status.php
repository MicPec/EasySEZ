<?php

namespace app\models;

use mako\database\midgard\ORM;

class Status extends ORM
{
    protected $tableName = 'status';
    protected $including = ['state'];
    protected $assignable = ['name', /*'state_id',*/ 'color'];

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function searchScope($query, $s)
    {
        return $query->where('name', 'LIKE', "%$s%");
    }
}
