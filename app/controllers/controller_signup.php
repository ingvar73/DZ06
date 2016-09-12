<?php
require_once __DIR__.'/../components/Db.php';
require_once __DIR__.'/../models/model_redirect.php';
// Читаем настройки config для отправки письма
require_once(__DIR__.'/../lib/phpmailer/PHPMailerAutoload.php');

class Controller_Signup extends Controller {

//    private $activation;
    private $id_activ;

    public function action_index()
    {
        $this->view->generate('signup_view.twig', array(
            "title"=> "Регистрация на сайте"
        ));
    }

    public function action_register()
    {
        $db = Db::getInstance();
        session_start();

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
                echo !$db->query("INSERT INTO users (login, password, email, date) VALUES ('{$reg->login}', '{$reg->password}', '{$reg->email}', '{$reg->date}')") ? : 'Пользователь успешно создан! На Ваш E-mail выслан код подтверждения!';

                // Подготовка к отправке сообщения на почту
                $active = $db->query("SELECT id, email FROM users WHERE login = '{$reg->login}'");
                $id_activ = $active->fetch_array();
                $activation = md5($id_activ['id']);
//                $_SESSION["id_active"] = $activation;
//                $_SESSION["id"] = $reg->id;

                try{
                    $mail = new PHPMailer(true); // Создаем экземпляр класса PHPMailer
                    require_once(__DIR__.'/../lib/config.php');
                    $mail->IsSMTP(); // Указываем режим работы с SMTP сервером
                    $mail->Host       = $__smtp['host'];  // Host SMTP сервера: ip или доменное имя
                    $mail->SMTPDebug  = $__smtp['debug'];  // Уровень журнализации работы SMTP клиента PHPMailer
                    $mail->SMTPAuth   = $__smtp['auth'];  // Наличие авторизации на SMTP сервере
                    $mail->Port       = $__smtp['port'];  // Порт SMTP сервера
                    $mail->SMTPSecure = $__smtp['secure'];  // Тип шифрования. Например ssl или tls
                    $mail->CharSet="UTF-8";  // Кодировка обмена сообщениями с SMTP сервером
                    $mail->Username   = $__smtp['username'];  // Имя пользователя на SMTP сервере
                    $mail->Password   = $__smtp['password'];  // Пароль от учетной записи на SMTP сервере
                    $mail->AddAddress($id_activ['email'], $reg->login);  // Адресат почтового сообщения
                    $mail->AddReplyTo($__smtp['addreply'], 'First Last');  // Альтернативный адрес для ответа
                    $mail->SetFrom($__smtp['username'], $__smtp['mail_title']);  // Адресант почтового сообщения
                    $mail->Subject = htmlspecialchars($__smtp['mail_title']);  // Тема письма
                    $mail->MsgHTML('Спасибо за регистрацию на нашем сайте DZ06.LOFTSCHOOL \r\n Ваш логин: '.$reg->login.'\r\n Для того чтобы войти в свой аккуант его нужно активировать.\n
Чтобы активировать ваш аккаунт, перейдите по ссылке:\n
http://dz06.loftschool/signup/activation/\r\n
С уважением, Администрация сайта'); // Текст сообщения
                    $mail->Send();
//                    return 1;
                    echo "<br>На Ваш E-mail выслано письмо с cсылкой, для активации вашего аккуанта. <a href='/'>Главная страница</a></p>";
                    return $id_activ;
                }
                catch (phpmailerException $e) {
                    return $e->errorMessage();
                }


            } else {
                foreach ($reg->getErrors() as $err){
                    echo $err.'<br />';
                }
            }
        }
    }

    public function action_activation()
    {
        session_start();
        $db = Db::getInstance();
        if ($db){
//            $act = $this->id_activ['id'];
            $active = $db->query("SELECT id FROM users WHERE login = '{$this->id_activ['login']}'");
            $id_activate = $active->fetch_array();
//            $activation = md5($id_activate['id']);
            if ($active){
                // код подтверждения совпадает - активируем
                echo !$db->query("UPDATE users SET activate = '1' WHERE login = '{$this->id_activ['login']}'");
                echo "Авторизован";
                var_dump($this->id_activ['login']);
//                Model_Redirect::redirectToPage('user/');
            }
        } else
        {
            echo "Сессия не открыта";
            var_dump($act);
        }
    }
}