<?php

namespace app\models;

use mako\database\midgard\ORM;

class StatusLog extends ORM
{
    protected $tableName = 'statuslog';
    protected $including = ['order'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    /**
     * Add log entry for order.
     *
     * @method addLog
     *
     * @param Order  $order    Order instance
     * @param string $username
     * @param string $comment
     */
    public function addLog(Order $order, $username, $comment = null)
    {
        $this->order_id = $order->id;
        $this->status = $order->status->name ?? '###';
        $this->date = date('Y-m-d H:i:s');
        $this->comment = $comment;
        $this->username = $username;
        $this->save();

        return $this;
    }
}
