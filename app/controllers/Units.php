<?php

namespace app\controllers;

use mako\view\ViewFactory;
// use mako\http\Request;
use app\models\Unit;

class Units extends BaseController
{
    public function show(ViewFactory $view)
    {
        $units = $this->filter(new Unit())->ascending('name')->paginate();

        return $view->assign('units', $units)->render('units');
    }

    public function filter(Unit $query)
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
        $unit = Unit::get($id);

        return $view->assign('unit', $unit)->render('unit');
    }

    public function update(ViewFactory $view, $id)
    {
        $unit = Unit::get($id);
        $unit->assign($this->request->post());
        $unit->save();

        $this->session->putFlash('msg', 'Zaktualizowano jednostkę #'.$unit->id.'|success');

        return $this->back();
    }

    public function new(ViewFactory $view)
    {
        return $view->render('unit');
    }

    public function create()
    {
        $unit = new Unit();
        $unit->assign($this->request->post());
        $unit->save();

        $this->session->putFlash('msg', 'Utworzono jednostkę '.$unit->name.'|success');

        return $this->back();
    }

    public function unitDeleteModal(ViewFactory $view, $id)
    {
        $unit = Unit::get($id);

        return $view->assign('question', 'Czy chcesz usunąć jednostkę "'.$unit->name.'"?')->
            assign('action', '/unit/delete')->
            assign('data', ['unit_id' => $unit->id])->
            render('chunks.confirmModal');
    }

    public function delete(ViewFactory $view)
    {
        $unit = Unit::get($this->request->post('unit_id'));

        $unit->delete();

        $this->session->putFlash('msg', 'Usunięto jednostkę "'.$unit->name.'".|danger');

        return $this->current();
    }

    public function select()
    {
        $items = [];
        $unit = Unit::search($this->request->get('s'))->ascending('name');
        $count = $unit->all()->count();
        foreach ($unit->paginate(10) as $obj) {
            $items[] = ['id' => $obj->id, 'text' => $obj->name];
        }
        $result = ['items' => $items, 'total_count' => $count];

        return json_encode($result);
    }
}
