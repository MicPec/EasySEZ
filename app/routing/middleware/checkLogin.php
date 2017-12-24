<?php

namespace app\routing\middleware;

use Closure;
use mako\gatekeeper\Authentication as Gatekeeper;
use mako\http\Request;
use mako\http\Response;
use mako\http\response\senders\Redirect;
use mako\http\routing\middleware\Middleware;
use mako\session\Session;

/**
 * checkLogin middleware
 * check if user is logged in.
 */
class checkLogin extends Middleware
{
    /**
     * __construct
     * @method __construct
     * @param  Gatekeeper  $gatekeeper Authentication instance
     * @param  Session     $session    Session instance
     */
    public function __construct(Gatekeeper $gatekeeper, Session $session)
    {
        $this->gatekeeper = $gatekeeper;
        $this->session = $session;
    }

    public function execute(Request $request, Response $response, Closure $next): Response
    {
        if ($this->gatekeeper->isGuest()) {
            $this->session->reflash();

            return $response->body(new Redirect('/login'));
        }

        return $next($request, $response);
    }
}
