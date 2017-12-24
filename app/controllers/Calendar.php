<?php

namespace app\controllers;

class Calendar extends BaseController
{
    public function show()
    {
        $month = $this->request->get('m');
        $year = $this->request->get('y');
        $calendar = new utils\Calendar($year, $month);

        return $this->view->assign('calendar', $calendar)->render('calendar');
    }
}
