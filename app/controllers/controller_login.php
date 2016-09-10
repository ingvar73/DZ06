<?php
require_once __DIR__.'/../components/Db.php';
require_once __DIR__.'/../models/model_redirect.php';
require_once __DIR__.'/../models/model_auth.php';
class Controller_Login extends Controller {
    public function action_index()
    {
        $this->view->generate('login_view.twig', array(
            "title"=> "Авторизация на сайте"
        ));
    }

    public function action_auth()
    {
        $db = Db::getInstance();

        if(isset($_POST['auth'])){
            session_start();
            $login = $db->escape($_POST['login']);
            $password = $db->escape($_POST['password']);

            $reg = new Model_Auth($login, $password);
            $reg->regex(Model_Auth::M_PASSWORD_PATTERN, $reg->password, 'Некорректный пароль!');
            $reg->regex(Model_Auth::LOGIN_PATTERN, $reg->login, 'Некорректный логин!');
            $reg->generateHash();
            $result = $db->query("SELECT login, password FROM users WHERE login = '{$reg->login}' AND password = '{$reg->password}' LIMIT 1");
//            $row = $db->fetch_assoc($result);
            $row = $result->num_rows;
//            var_dump($row);


            if(empty($reg->getErrors())){
                if ($row > 0){
                    print ("Пользователь авторизован!");
                    $_SESSION["login"] = $login;
                    $_SESSION["password"] = $password;
                } else{
                    echo "Пользователь не существует, зарегистрируйтесь";
                    Model_Redirect::redirectToPage('user/');
                }

                //Все хорошо, переход на страницу пользователя

            } else {
                foreach ($reg->getErrors() as $err){
                    echo $err.'<br />';
                }
            }
        }
    }
}