<?php

namespace app\routing\middleware;

use Closure;
use mako\http\Request;
use mako\http\Response;
use mako\http\routing\middleware\Middleware;
use mako\http\response\senders\Redirect;
use mako\gatekeeper\Authentication as Gatekeeper;
use mako\session\Session;
use mako\gatekeeper\entities\group\Group;
use app\models\User;

/**
 * checkLogin middleware
 * check if user is in admin group.
 */
class adminAccess extends Middleware
{
    public function __construct(Gatekeeper $gatekeeper, Session $session)
    {
        $this->session = $session;
        $this->gatekeeper = $gatekeeper;
    }

    public function execute(Request $request, Response $response, Closure $next): Response
    {
        $user = $this->gatekeeper->getUser();
        if (!$user->isMemberOf('admin')) {
            $this->session->putFlash('msg', 'Nie masz uprawnień do wykonania tej czynności. Skontaktuj się z administratorem.|danger');

            $route = $this->session->get('lastPage');

            return $response->body(new Redirect($route['path'], $route['data'], '&'));
        }

        return $next($request, $response);
    }
}
