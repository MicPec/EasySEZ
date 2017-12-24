<?php

namespace app\models;

// use mako\database\midgard\ORM;
use mako\gatekeeper\entities\user\User as authUser;

class User extends authUser
{
    public function statusLog()
    {
        return $this->hasMany(StatusLog::class)->ascending('date');
    }

    public function searchScope($query, $s)
    {
        return $query->where('username', 'LIKE', "%$s%")->orWhere('email', 'LIKE', "%$s%");
    }
}
