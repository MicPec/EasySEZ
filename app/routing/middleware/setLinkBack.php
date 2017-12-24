<?php

namespace app\routing\middleware;

use Closure;
use mako\http\Request;
use mako\http\Response;
use mako\http\routing\URLBuilder;
use mako\http\routing\middleware\Middleware;
use mako\session\Session;

/**
 * setLinkBack middleware
 * set links to previous/current page.
 */
class setLinkBack extends Middleware
{
    public function __construct(Session $session, URLBuilder $urlBuilder)
    {
        $this->session = $session;
        $this->urlBuilder = $urlBuilder;
    }

    public function execute(Request $request, Response $response, Closure $next): Response
    {
        if ('GET' == $request->method()) {
            if ($this->session->has('currentPage')) {
                if ($this->session->get('currentPage')['path'] != $request->path()) {
                    $this->session->put('lastPage', $this->session->get('currentPage'));
                }
            }
            $this->session->put('currentPage', ['path' => $request->path(), 'data' => $request->data()]);
        }

        return $next($request, $response);
    }
}
