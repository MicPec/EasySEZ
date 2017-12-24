<?php

namespace app\controllers;

use mako\view\ViewFactory;
// use mako\http\Request;
use app\models\Status;

class Statuses extends BaseController
{
    public function show(ViewFactory $view)
    {
        $statuses = $this->filter(new Status())->ascending('name')->paginate();

        return $view->assign('statuses', $statuses)->render('statuses');
    }

    public function filter(Status $query)
    {
        // search filter
        if ($this->request->get('s')) {
            $query = $query->search($this->request->get('s'));
        }
        // id filter
        if ($this->request->get('id')) {
            $query = $query->where('id', '=', $this->request->get('id'));
        }

        return $query;
    }

    public function get(ViewFactory $view, $id)
    {
        $status = Status::get($id);

        return $view->assign('status', $status)->render('status');
    }

    public function new(ViewFactory $view)
    {
        return $view->render('status');
    }

    public function create(ViewFactory $view)
    {
        $status = new Status();
        $status->assign($this->request->post());
        $status->state_id = $this->request->post('state_id');
        $status->save();

        $this->session->putFlash('msg', 'Utworzono status "'.$status->name.'"|success');

        return $this->back();
    }

    public function update(ViewFactory $view, $id)
    {
        $status = Status::get($id);
        $status->assign($this->request->post());
        $status->state_id = $this->request->post('state_id');
        $status->save();

        $this->session->putFlash('msg', 'Zaktualizowano status "'.$status->name.'"|success');

        return $this->back();
    }

    public function statusDeleteModal(ViewFactory $view, $id)
    {
        $status = Status::get($id);

        return $view->assign('question', 'Czy chcesz usunąć status "'.$status->name.'"?')->
            assign('action', '/status/delete')->
            assign('data', ['status_id' => $status->id])->
            render('chunks.confirmModal');
    }

    public function delete(ViewFactory $view)
    {
        $status = Status::get($this->request->post('status_id'));

        $status->delete();

        $this->session->putFlash('msg', 'Usunięto status "'.$status->name.'".|danger');

        return $this->current();
    }

    public function select()
    {
        $items = [];
        $status = Status::search($this->request->get('s'))->ascending('name');
        $count = $status->all()->count();
        foreach ($status->paginate(10) as $obj) {
            $items[] = ['id' => $obj->id, 'text' => $obj->name];
        }
        $result = ['items' => $items, 'total_count' => $count];

        return json_encode($result);
    }
}
