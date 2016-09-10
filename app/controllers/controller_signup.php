<?php
require_once __DIR__.'/../components/Db.php';
class Controller_Signup extends Controller {
    public function action_index()
    {
        $this->view->generate('signup_view.twig', array(
            "title"=> "Регистрация на сайте"
        ));
    }

    public function action_register()
    {
        $db = Db::getInstance();

        if(isset($_POST['register'])){
            $login = $db->escape($_POST['login']);
            $password = $db->escape($_POST['password']);
            $confirm_password = $db->escape($_POST['cpassword']);
            $email = $db->escape($_POST['email']);
            $reg = new Model_Signup($login, $password, $confirm_password, $email);
            $result = $db->query("SELECT COUNT(login) FROM users WHERE login = '{$reg->login}'");
            $row = $db->fetch_assoc($result);
            $reg->unique($row, 'Логин неуникален!');
            $result = $db->query("SELECT COUNT(email) FROM users WHERE email = '{$reg->email}'");
            $row = $db->fetch_assoc($result);
            $reg->unique($row, 'Email неуникален!');
            $reg->quality($reg->password, $reg->confirm_password, 'Пароли не совпадают!');
            $reg->regex(Model_Signup::M_PASSWORD_PATTERN, $reg->password, 'Некорректный пароль!');
            $reg->regex(Model_Signup::LOGIN_PATTERN, $reg->login, 'Некорректный логин!');
            $reg->regex(Model_Signup::EMAIL_PATTERN, $reg->email, 'Некорректный email!');
            if(empty($reg->getErrors())){
                $reg->generateHash();
                echo !$db->query("INSERT INTO users (login, password, email, date) VALUES ('{$reg->login}', '{$reg->password}', '{$reg->email}', '{$reg->date}')") ? : 'Пользователь успешно создан!';
            } else {
                foreach ($reg->getErrors() as $err){
                    echo $err.'<br />';
                }
            }
        }
    }
}