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

            $result = $db->query("SELECT id, password FROM users WHERE login = '{$reg->login}'");
            $row = $db->fetch_assoc($result);
//            var_dump($row['password']);
//            var_dump($reg->password);

            $reg->quality($reg->password, $row['password'], 'Пароли не совпадают или пользователь не зарегистрирован!');


            if(empty($reg->getErrors())){
                if ($row > 0){
                    print ("Пользователь авторизован!");
                    setcookie("id", $row['id'], time()+60*60*24*30);
                    $_SESSION["login"] = $login;
                    $_SESSION["password"] = $password;

                } else{
                    echo "Пользователь не существует, зарегистрируйтесь";
                }
                Model_Redirect::redirectToPage('user/');

                //Все хорошо, переход на страницу пользователя

            } else {
                foreach ($reg->getErrors() as $err){
                    echo $err.'<br />';
                }
            }
        }
    }
}