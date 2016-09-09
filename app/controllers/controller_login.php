<?php

class Controller_Login extends Controller {
    public function action_index()
    {
        $this->view->generate('login_view.twig', array(
            "title"=> "Авторизация на сайте"
        ));
    }
}