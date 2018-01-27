<?php

namespace app\controllers;

use mako\http\routing\Controller;

class BaseController extends Controller
{

    public function back()
    {
        $route = $this->session->get('lastPage') ?? ['path' => '/', 'data' => []];
        $url = $this->urlBuilder->to($route['path'], $route['data'], '&');

        return $this->redirectResponse($url);
    }

    public function current()
    {
        $route = $this->session->get('currentPage') ?? ['path' => '/', 'data' => []];
        $url = $this->urlBuilder->to($route['path'], $route['data'], '&');

        return $this->redirectResponse($url);
    }
}
