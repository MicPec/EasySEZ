<?php

namespace app\controllers;

use mako\view\ViewFactory;
use app\models\User;
use mako\security\Password;
use mako\gatekeeper\entities\group\Group;

class Users extends BaseController
{
    public function show(ViewFactory $view)
    {
        $users = $this->filter(new User())->ascending('username')->paginate();

        return $view->assign('users', $users)->render('users');
    }

    public function filter(User $query)
    {
        // search filter
        if ($this->request->get('s')) {
            $query = $query->search($this->request->get('s'));
        }
        // id filter
        if ($this->request->get('id')) {
            $query = $query->where('id', '=', $this->request->get('id'));
        }

        return $query;
    }

    public function get(ViewFactory $view, $id)
    {
        $user = User::get($id);

        return $view->assign('user', $user)->render('user');
    }

    public function update(ViewFactory $view, $id)
    {
        $user = User::get($id);
        $user->username = $this->request->post('username');
        $user->email = $this->request->post('email');
        // $product->unit_id = $this->request->post('unit');
        $user->save();

        $user = User::get($id);
        $groups = Group::all();
        foreach ($groups as $group) {
            $group->removeUser($user);
            if ($group->id == $this->request->post('group_id')) {
                $group->addUser($user);
            }
        }

        $this->session->putFlash('msg', 'Zaktualizowano dane użytkownika #'.$user->username.'|success');

        return $this->back();
    }

    public function changePassword(ViewFactory $view, $id)
    {
        $user = User::get($id);

        return $view->assign('user', $user)->render('changePassword');
    }

    public function updatePassword(ViewFactory $view, $id)
    {
        $user = User::get($id);
        if (Password::validate($this->request->post('oldpass'), $user->getPassword())
        || $this->gatekeeper->getUser()->isMemberOf('admin')) { //dont check oldpass if admin is logged in
            $user->setPassword($this->request->post('newpass'));
            $user->save();
            $this->session->putFlash('msg', 'Zaktualizowano hasło|success');
        } else {
            $this->session->putFlash('msg', 'Nie zaktualizowano hasła!|danger');
        }

        return $this->back();
    }

    public function banUserModal(ViewFactory $view, $id)
    {
        $user = User::get($id);

        return $view->assign('question', 'Czy chcesz zbanować użytkownika "'.$user->username.'"?')->
            assign('action', '/user/ban')->
            assign('data', ['user_id' => $user->id])->
            render('chunks.confirmModal');
    }

    public function unbanUserModal(ViewFactory $view, $id)
    {
        $user = User::get($id);

        return $view->assign('question', 'Czy chcesz zdjąć bana użytkownika "'.$user->username.'"?')->
            assign('action', '/user/unban')->
            assign('data', ['user_id' => $user->id])->
            render('chunks.confirmModal');
    }

    public function ban(ViewFactory $view)
    {
        $user = User::get($this->request->post('user_id'));
        $user->ban();
        $user->save();

        $this->session->putFlash('msg', 'Zbanowano użytkownika "'.$user->username.'".|warning');

        return $this->current();
    }

    public function unban(ViewFactory $view)
    {
        $user = User::get($this->request->post('user_id'));
        $user->unban();
        $user->save();

        $this->session->putFlash('msg', 'Z użytkownika "'.$user->username.'" zdjęto bana.|success');

        return $this->current();
    }

    /**
     * API select helper function for Select2.
     *
     * @method select
     *
     * @return string json encoded
     */
    public function select()
    {
        $items = [];
        $user = User::search($this->request->get('s'))->ascending('username');
        $count = $user->all()->count();
        foreach ($user->paginate(10) as $obj) {
            $items[] = ['id' => $obj->id, 'text' => $obj->username];
        }
        $result = ['items' => $items, 'total_count' => $count];

        return json_encode($result);
    }

    /**
     * API selectGroup helper function for Select2.
     *
     * @method selectGroup
     *
     * @return string json encoded
     */
    public function selectGroup()
    {
        $items = [];
        $groups = Group::all();
        foreach ($groups as $obj) {
            $items[] = ['id' => $obj->id, 'text' => $obj->name];
        }
        $result = ['items' => $items, 'total_count' => $groups->count()];

        return json_encode($result);
    }
}
