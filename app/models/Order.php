<?php

namespace app\models;

use mako\database\midgard\ORM;

class Order extends ORM
{
    protected $tableName = 'order';
    protected $assignable = ['product_id', 'client_id', 'qty', 'note', 'price', 'deadline'];
    // protected $cast = ['date' => 'date', 'finishdate' => 'date', 'deadline' => 'date'];
    protected $including = ['user', 'product', 'product.unit', 'status', 'client', 'flags'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function statusLog()
    {
        return $this->hasMany(StatusLog::class)->ascending('date');
    }

    public function flags()
    {
        return $this->manyToMany(Flag::class, 'order_id', 'order_flags');
    }

    public function searchScope($query, $s)
    {
        return $query->join('client', 'client.id', '=', 'order.client_id')
            ->join('product', 'product.id', '=', 'order.product_id')
            ->where('client.company', 'LIKE', "%$s%")->orWhere('client.fname', 'LIKE', "%$s%")->orWhere('client.sname', 'LIKE', "%$s%")
            ->orWhere('product.name', 'LIKE', "%$s%")
            ->orWhere('note', 'LIKE', "%$s%");
    }
}
