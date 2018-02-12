<?php

namespace app\controllers;

use mako\view\ViewFactory;
use app\models\Order;
use app\models\Status;
use app\models\Client;
use app\models\Product;
use mako\utility\Arr;

/**
 * Dashboard controller.
 */
class Dashboard extends BaseController
{
    public function show(ViewFactory $view)
    {
        // $orders = $this->filter(new Order())->descending('date')->paginate();
        $view->assign('ordersCount', $this->getOrdersCount());
        $view->assign('clientsCount', $this->getClientsCount());
        $view->assign('inprogressCount', $this->getInprogressCount());
        $view->assign('newCount', $this->getNewCount());

        $view->assign('ordersByYou', $this->getOrdersByYou());
        $view->assign('startedToday', $this->getStartedToday());
        $view->assign('startedThisWeek', $this->getStartedThisWeek());
        $view->assign('startedThisMonth', $this->getStartedThisMonth());
        $view->assign('endedToday', $this->getEndedToday());
        $view->assign('endedThisWeek', $this->getEndedThisWeek());
        $view->assign('endedThisMonth', $this->getEndedThisMonth());

        $view->assign('bestClients', $this->getBestClients());
        $view->assign('bestProducts', $this->getBestProducts());

        $calendar = new utils\Calendar();
        $view->assign('calendar', $calendar);

        return $view->render('dashboard');
    }

    public function getOrdersCount(): int
    {
        return Order::count();
    }

    public function getClientsCount(): int
    {
        return Client::count();
    }

    public function getInprogressCount(): int
    {
        $statuses = Arr::pluck(Status::where('state_id', '=', '2')->all()->toArray(), 'id');
        if (empty($statuses)) {
            return 0;
        }

        return Order::in('status_id', $statuses)->count();
    }

    public function getNewCount(): int
    {
        $statuses = Arr::pluck(Status::where('state_id', '=', '1')->all()->toArray(), 'id');
        if (empty($statuses)) {
            return 0;
        }

        return Order::in('status_id', $statuses)->count();
    }

    public function getOrdersByYou(): int
    {
        return Order::where('user_id', '=', $this->gatekeeper->getUser()->id)->count();
    }

    public function getStartedToday(): int
    {
        return Order::where('date', '>=', date('Y-m-d'))->count();
    }

    public function getStartedThisWeek(): int
    {
        return Order::where('date', '>', date('Y-m-d', strtotime('last sunday')))->count();
    }

    public function getStartedThisMonth(): int
    {
        return Order::where('date', '>=', date('Y-m-01'))->count();
    }

    public function getEndedToday(): int
    {
        return Order::where('finishdate', '>=', date('Y-m-d'))->count();
    }

    public function getEndedThisWeek(): int
    {
        return Order::where('finishdate', '>', date('Y-m-d', strtotime('last sunday')))->count();
    }

    public function getEndedThisMonth(): int
    {
        return Order::where('finishdate', '>=', date('Y-m-01'))->count();
    }

    public function getBestClients()
    {
        return (new Client())->ordersCount()->descending('ordersCount', 'sname')->limit(5)->all();
    }

    public function getBestProducts()
    {
        return (new Product())->ordersCount()->descending('ordersCount', 'name')->limit(5)->all();
    }
}
