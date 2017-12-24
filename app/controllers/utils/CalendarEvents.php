<?php

namespace app\controllers\utils;

use app\models\Order;

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
        $orders = Order::between('date', $this->startDate, $this->endDate)->orBetween('deadline', $this->startDate, $this->endDate)->orBetween('finishdate', $this->startDate, $this->endDate)->all();
        foreach ($orders as $order) {
            $this->orders[substr($order->date, 0, 10)][] = ['order' => $order, 'type' => 'start'];
            $this->orders[substr($order->finishdate, 0, 10)][] = ['order' => $order, 'type' => 'end'];
            $this->orders[substr($order->deadline, 0, 10)][] = ['order' => $order, 'type' => 'deadline'];
        }
        // var_dump($this->orders);
    }

    public function get($date)
    {
        return $this->orders[$date] ?? [];
    }
}
