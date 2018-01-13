<?php

namespace app\controllers\utils;

use app\models\Order;
use app\models\Status;
use mako\utility\Arr;

/**
 * CalendarEvents class.
 */
class CalendarEvents
{
    private $startDate;
    private $endDate;
    private $orders = [];

    public function __construct(\Datetime $startDate, \Datetime $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $statuses = Arr::pluck(Status::in('state_id', [1, 2])->all()->toArray(), 'id');
        $orders = Order::in('status_id', $statuses)->where(function ($query) {
            $query->between('date', $this->startDate, $this->endDate)->orBetween('deadline', $this->startDate, $this->endDate)->orBetween('finishdate', $this->startDate, $this->endDate)->distinct();
        })->descending('date')->all();
        foreach ($orders as $order) {
            $this->orders[substr($order->date, 0, 10)][] = ['order' => $order, 'type' => 'start'];
            $this->orders[substr($order->finishdate, 0, 10)][] = ['order' => $order, 'type' => 'end'];
            $this->orders[substr($order->deadline, 0, 10)][] = ['order' => $order, 'type' => 'deadline'];
        }
    }

    public function get($date)
    {
        return $this->orders[$date] ?? [];
    }
}
