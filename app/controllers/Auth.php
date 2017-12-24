<?php

namespace app\controllers;

use mako\view\ViewFactory;
use mako\gatekeeper\Authentication;

// use mako\http\Request;

class Auth extends BaseController
{
    public function showLogin(ViewFactory $view)
    {
        return $view->render('login');
    }

    public function login()
    {
        $email = $this->request->post('email');
        $password = $this->request->post('password');
        $remember = $this->request->post('remember');

        $logged = $this->gatekeeper->login($email, $password, $remember);
        if (true === $logged) {
            $msg = 'Witaj, '.$this->gatekeeper->getUser()->username.'|success';
        } else {
            switch ($logged) {
            case Authentication::LOGIN_INCORRECT:
              $msg = 'Nieprawidłowy login lub hasło!|danger';
            break;
            case Authentication::LOGIN_ACTIVATING:
              $msg = 'Konto nie zostało aktywowane!|danger';
            break;
            case Authentication::LOGIN_BANNED:
              $msg = 'Użytkownik zbanowany!|danger';
            break;
            case Authentication::LOGIN_LOCKED:
              $msg = 'Konto czasowo zablokowane!|danger';
            break;
            default:
              $msg = 'Wystąpił nieznany błąc!|danger';
            break;
          }
        }
        $this->session->putFlash('msg', $msg);

        return $this->redirectResponse('/');
    }

    public function logout()
    {
        $this->gatekeeper->logout();
        $this->session->putFlash('msg', 'Zaloguj się ponownie.|success');

        return $this->redirectResponse('/');
    }
}
