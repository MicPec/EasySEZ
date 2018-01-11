<?php

namespace app\controllers;

class Calendar extends BaseController
{
    public function show()
    {
        $month = $this->request->getQuery()->get('m');
        $year = $this->request->getQuery()->get('y');
        $calendar = new utils\Calendar($year, $month);

        return $this->view->assign('calendar', $calendar)->render('calendar');
    }
}
