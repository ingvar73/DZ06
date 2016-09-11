<?php
require_once __DIR__.'/../components/Db.php';
class Model_User extends Model {

    public function get_data()
    {
        session_start();
        $db = Db::getInstance();

        if (!empty($_SESSION['login']) and !empty($_SESSION['password'])) {
            //если существует логин и пароль в сессиях, то проверяем их
            $login = $_SESSION['login'];
            $password = $_SESSION['password'];
            $result = $db->query("SELECT id, login, email FROM users WHERE login='$login'");
            $myrow = $result->fetch_assoc();
            var_dump($myrow);
        return array(
            array(
                "login" => $myrow['login'],
                "email" => $myrow['email'],
                )
            );
        }
    }

}