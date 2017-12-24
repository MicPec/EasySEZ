<?php

namespace app\controllers;

use mako\http\routing\Controller;
use mako\view\ViewFactory;
use mako\session\Session;
use mako\http\routing\URLBuilder;
use mako\http\Request;
use mako\gatekeeper\Authentication as Gatekeeper;

class BaseController extends Controller
{

    public function __construct(ViewFactory $view, Session $session, URLBuilder $urlBuilder, Request $request, Gatekeeper $gatekeeper)
    {
        $view->assign('session', $session);
        $view->assign('urlBuilder', $urlBuilder);
        $view->assign('request', $request);
        $view->assign('gatekeeper', $gatekeeper);
    }

    public function back()
    {
        $route = $this->session->get('lastPage');
        $url = $this->urlBuilder->to($route['path'], $route['data'], '&');

        return $this->redirectResponse($url);
    }

    public function current()
    {
        $route = $this->session->get('currentPage');
        $url = $this->urlBuilder->to($route['path'], $route['data'], '&');

        return $this->redirectResponse($url);
    }
}
