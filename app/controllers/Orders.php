<?php

namespace app\controllers;

use app\models\StatusLog;
use mako\view\ViewFactory;
use app\models\Order;
use app\models\Status;
use app\models\Flag;
use mako\utility\Arr;

class Orders extends BaseController
{
    /**
     * Print Orders.
     *
     * @param ViewFactory $view
     *
     * @return [type] [description]
     */
    public function show(ViewFactory $view)
    {
        $orders = $this->filter(new Order())->descending('date')->paginate();

        return $view->assign('orders', $orders)->render('orders');
    }

    /**
     * open status modal window.
     *
     * @param ViewFactory $view
     * @param int         $id   Order id
     *
     * @return ViewFactory
     */
    public function getStatusModal(ViewFactory $view, $id)
    {
        $order = Order::get($id);

        return $view->assign('order', $order)->render('chunks.statusModal');
    }

    public function getAddFlagModal(ViewFactory $view, $id)
    {
        $order = Order::get($id);

        return $view->assign('order', $order)->render('chunks.addFlagModal');
    }

    public function removeFlagModal(ViewFactory $view, $id, $flag)
    {
        $order = Order::get($id);

        return $view->assign('question', 'Usuąć flagę "'.Flag::get($flag)->name.'" ze zlecenia #'.$id.'?')->
            assign('action', '/order/'.$id.'/removeflag')->
            assign('data', ['flag' => $flag])->
            render('chunks.confirmModal');
    }

    public function changeStatus(ViewFactory $view, $id)
    {
        $order = Order::get($id);
        $status = Status::get($this->request->post('status'));
        // $order->status_id = $status->id;
        $status->orders()->create($order);
        if (isset($status->state->name) && ('end' == $status->state->name)) {
            $order->finishdate = date('Y-m-d');
        }
        $order->save();

        $statuslog = new StatusLog();
        $statuslog->addLog(Order::get($id), $this->gatekeeper->getUser()->username, $this->request->post('comment') ?? null);

        $this->session->putFlash('msg', 'Zmieniono status zlecenia #'.$order->id.'|success');

        return $this->current();
    }

    public function summary(ViewFactory $view, $id)
    {
        $order = Order::get($id);

        return $view->assign('order', $order)->render('summary');
    }

    public function statusLog(ViewFactory $view, $id)
    {
        $order = Order::get($id);

        if (0 == $order->statusLog->count()) {
            $this->session->putFlash('msg', 'Nie znaleziono historii zlecenia #'.$order->id.'|warning');

            return $this->back();
        }

        return $view->assign('statuslog', $order->statusLog)->render('statuslog');
    }

    public function get(ViewFactory $view, $id)
    {
        $order = Order::get($id);

        return $view->assign('order', $order)->render('order');
    }

    public function new(ViewFactory $view)
    {
        return $view->render('order');
    }

    public function create(ViewFactory $view)
    {
        $order = new Order();
        $order->assign($this->request->post());
        $order->status_id = Status::where('state_id', '=', '1')->first()->id;
        $order->date = date('Y-m-d H:i:s');
        $order->price = $this->request->post('price') ? $this->request->post('price') : null;
        $order->deadline = $this->request->post('deadline') ? $this->request->post('deadline') : null;
        $order->user_id = $this->gatekeeper->getUser()->id;
        $order->save();

        $statuslog = new StatusLog();
        $statuslog->addLog($order, $this->gatekeeper->getUser()->username, 'Utworzono zlecenie');

        $this->session->putFlash('msg', 'Utworzono zlecenie #'.$order->id.'|success');

        return $this->back();
    }

    public function update(ViewFactory $view, $id)
    {
        $order = Order::get($id);
        $order->assign($this->request->post());
        $order->price = $this->request->post('price') ? $this->request->post('price') : null;
        $order->deadline = $this->request->post('deadline') ? $this->request->post('deadline') : null;
        $order->save();

        $statuslog = new StatusLog();
        $statuslog->addLog($order, $this->gatekeeper->getUser()->username, 'Edytowano zlecenie');

        $this->session->putFlash('msg', 'Zaktualizowano zlecenie #'.$order->id.'|success');

        return $this->back();
    }

    public function addFlag(ViewFactory $view, $id)
    {
        $order = Order::get($id);
        $flag = $this->request->post('flag');
        if (!$order->flags()->get($flag)) {
            $order->flags()->link($flag);

            $this->session->putFlash('msg', 'Dodano flagę do zlecenia #'.$order->id.'|success');
        }

        return $this->current();
    }

    public function removeFlag(ViewFactory $view, $id)
    {
        $order = Order::get($id);
        $flag = $this->request->post('flag');
        if ($order->flags()->get($flag)) {
            $order->flags()->unlink($flag);

            $this->session->putFlash('msg', 'Usunięto flagę ze zlecenia #'.$order->id.'|success');
        }

        return $this->current();
    }

    public function filter(Order $query)
    {
        if ($this->request->get('qf')) {
            switch ($this->request->get('qf')) {
                case 'inprogress':
                    $statuses = Arr::pluck(Status::where('state_id', '=', '2')->all()->toArray(), 'id');
                    if (empty($statuses)) {
                        break;
                    }
                    $query = $query->in('status_id', $statuses);
                    break;
                case 'new':
                    $statuses = Arr::pluck(Status::where('state_id', '=', '1')->all()->toArray(), 'id');
                    if (empty($statuses)) {
                        break;
                    }
                    $query = $query->in('status_id', $statuses);
                    break;
                case 'thismonth':
                    $query = $query->where('date', '>=', date('Y-m-01'));
                    break;
                case 'endedthismonth':
                    $query = $query->where('finishdate', '>=', date('Y-m-01'));
                    break;
                case 'thisweek':
                    $query = $query->where('date', '>=', date('Y-m-d', strtotime('-1 week monday')));
                    break;
                case 'endedthisweek':
                    $query = $query->where('finishdate', '>=', date('Y-m-d', strtotime('-1 week monday')));
                    break;
                case 'today':
                    $query = $query->where('date', '>=', date('Y-m-d'));
                    break;
                case 'endedtoday':
                    $query = $query->where('finishdate', '>=', date('Y-m-d 00:00:00'));
                    break;
                default:
                    $query = $query;
            }
        }
        // search filter
        if ($this->request->get('s')) {
            $query = $query->search($this->request->get('s'));
        }
        // id filter
        if ($this->request->get('id')) {
            $query = $query->where('id', '=', $this->request->get('id'));
        }
        // date filter
        if ($this->request->get('datefrom') && $this->request->get('dateto')) {
            $query = $query->between('date', $this->request->get('datefrom'), $this->request->get('dateto'));
        }
        // finishdate filter
        if ($this->request->get('fdatefrom') && $this->request->get('fdateto')) {
            $query = $query->between('finishdate', $this->request->get('fdatefrom'), $this->request->get('fdateto'));
        }
        // deadline filter
        if ($this->request->get('deadlinefrom') && $this->request->get('deadlineto')) {
            $query = $query->between('deadline', $this->request->get('deadlinefrom'), $this->request->get('deadlineto'));
        }
        // client filter
        if ($this->request->get('client')) {
            $query = $query->where('client_id', '=', $this->request->get('client'));
        }
        // user filter
        if ($this->request->get('user')) {
            $query = $query->where('user_id', '=', $this->request->get('user'));
        }
        // status filter
        if ($this->request->get('status')) {
            $query = $query->where('status_id', '=', $this->request->get('status'));
        }
        // product filter
        if ($this->request->get('product')) {
            $query = $query->where('product_id', '=', $this->request->get('product'));
        }
        // flags filter
        if ($this->request->get('flag')) {
            $query = $query->join('order_flags', 'order_id', '=', 'order.id')->where('flag_id', '=', $this->request->get('flag'));
        }

        return $query;
    }
}
