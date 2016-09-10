<?php

class Controller_User extends Controller {

    function action_index()
    {
        $this->view->generate('user_view.twig', array('title'=>'Страница пользователя'));
    }

}