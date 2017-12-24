<?php

namespace app\controllers;

use app\models\State;

class States extends BaseController
{
    public function select()
    {
        $items = [];
        $status = State::search($this->request->get('s'))->ascending('name');
        $count = $status->all()->count();
        foreach ($status->paginate(10) as $obj) {
            $items[] = ['id' => $obj->id, 'text' => $obj->name];
        }
        $result = ['items' => $items, 'total_count' => $count];

        return json_encode($result);
    }
}
