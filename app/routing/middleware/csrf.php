<?php

namespace app\routing\middleware;

use Closure;
use mako\http\Request;
use mako\http\Response;
use mako\http\routing\middleware\Middleware;
use mako\http\response\senders\Redirect;
use mako\validator\ValidatorFactory;
use mako\session\Session;

/**
 * checkLogin middleware
 * check if user is logged in.
 */
class csrf extends Middleware
{
    public function __construct(ValidatorFactory $validator, Session $session)
    {
        $this->validator = $validator;
        $this->session = $session;
    }

    public function execute(Request $request, Response $response, Closure $next): Response
    {
        $validator = $this->validator->create($request->getPost()->all(), ['csrf_token' => ['one_time_token', 'required']]);
        if ($validator->isInvalid($err)) {
            $this->session->putFlash('msg', 'Błąd walidacji: nieprawidłowy token|danger');

            $route = $this->session->get('currentPage');

            return $response->body(new Redirect($route['path'], [], $route['data'], '&'));
            // return $this->redirectResponse($route['path'], [], $route['data'], '&');
        }

        return $next($request, $response);
    }
}
