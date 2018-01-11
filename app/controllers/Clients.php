<?php

namespace app\controllers;

use mako\view\ViewFactory;
// use mako\http\Request;
use app\models\Client;

class Clients extends BaseController
{
    public function show(ViewFactory $view)
    {
        $clients = $this->filter(new Client())->ordersCount()->ascending('sname', 'name')->paginate();

        return $view->assign('clients', $clients)->render('clients');
    }

    public function filter(Client $query)
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
        $client = Client::get($id);

        return $view->assign('client', $client)->render('client');
    }

    public function new(ViewFactory $view)
    {
        return $view->render('client');
    }

    public function create(ViewFactory $view)
    {
        $client = new Client();
        $client->assign($this->request->getPost()->all());
        $client->save();

        $this->session->putFlash('msg', 'Utworzono klienta "'.$client->sname.' '.$client->fname.' ('.$client->company.')|success');

        return $this->back();
    }

    public function update(ViewFactory $view, $id)
    {
        $client = Client::get($id);
        $client->assign($this->request->getPost()->all());
        $client->save();
        $this->session->putFlash('msg', "Zaktualizowano dane klienta $client->sname|success");

        return $this->back();
    }

    public function clientDeleteModal(ViewFactory $view, $id)
    {
        $client = Client::get($id);

        return $view->assign('question', "Czy chcesz usunąć klienta $client->sname $client->fname?")->
            assign('action', '/client/delete')->
            assign('data', ['client_id' => $client->id])->
            render('chunks.confirmModal');
    }

    public function delete(ViewFactory $view)
    {
        $client = Client::get($this->request->getPost()->get('client_id'));

        $client->delete();

        $this->session->putFlash('msg', 'Usunięto klienta "'.$client->sname.' '.$client->fname.'".|danger');

        return $this->current();
    }

    public function select()
    {
        $items = [];
        $clients = Client::search($this->request->getQuery()->get('s'))->ascending('sname', 'name');
        $count = $clients->all()->count();
        foreach ($clients->paginate(10) as $obj) {
            $items[] = ['id' => $obj->id, 'text' => $obj->sname.' '.$obj->fname.' ('.$obj->company.')'];
        }
        $result = ['items' => $items, 'total_count' => $count];

        return json_encode($result);
    }
}
