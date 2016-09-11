<?php

class Controller_User extends Controller {

    function action_index()
    {
        $this->model = new Model_User();
        $this->view = new View();
        $this->view->generate('user_view.twig', array('title'=>'Страница пользователя'));
    }

}