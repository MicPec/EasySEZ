<?php

namespace app\controllers;

use mako\view\ViewFactory;
// use mako\http\Request;
use app\models\Flag;

class Flags extends BaseController
{
    public function show(ViewFactory $view)
    {
        $flags = $this->filter(new Flag())->ascending('name')->paginate();

        return $view->assign('flags', $flags)->render('flags');
    }

    public function filter(Flag $query)
    {
        // search filter
        if ($this->request->getQuery()->get('s')) {
            $query = $query->search($this->request->getQuery()->get('s'));
        }
        // id filter
        if ($this->request->getQuery()->get('id')) {
            $query = $query->where('id', '=', $this->request->getQuery()->get('id'));
        }

        return $query;
    }

    public function get(ViewFactory $view, $id)
    {
        $flag = Flag::get($id);

        return $view->assign('flag', $flag)->render('flag');
    }

    public function new(ViewFactory $view)
    {
        return $view->render('flag');
    }

    public function flagDeleteModal(ViewFactory $view, $id)
    {
        $flag = Flag::get($id);

        return $view->assign('question', 'Czy chcesz usunąć flagę "'.$flag->name.'"?')->
            assign('action', '/flag/delete')->
            assign('data', ['flag_id' => $flag->id])->
            render('chunks.confirmModal');
    }

    public function delete(ViewFactory $view)
    {
        $flag = Flag::get($this->request->getPost()->get('flag_id'));

        $flag->delete();

        $this->session->putFlash('msg', 'Usunięto flagę "'.$flag->name.'".|danger');

        return $this->current();
    }

    public function create(ViewFactory $view)
    {
        $flag = new Flag();
        $flag->assign($this->request->getPost()->all());
        $flag->save();

        $this->session->putFlash('msg', 'Utworzono flagę "'.$flag->name.'"|success');

        return $this->back();
    }

    public function update(ViewFactory $view, $id)
    {
        $flag = Flag::get($id);
        $flag->assign($this->request->getPost()->all());
        $flag->save();

        $this->session->putFlash('msg', 'Zaktualizowano flagę "'.$flag->name.'"|success');

        return $this->back();
    }

    public function select()
    {
        $items = [];
        $flags = Flag::search($this->request->getQuery()->get('s'))->ascending('name');
        $count = $flags->all()->count();
        foreach ($flags->paginate(10) as $obj) {
            $items[] = ['id' => $obj->id, 'text' => $obj->name];
        }
        $result = ['items' => $items, 'total_count' => $count];

        return json_encode($result);
    }
}
