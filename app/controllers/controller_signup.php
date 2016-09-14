<?php
require_once __DIR__.'/../components/Db.php';
require_once __DIR__.'/../models/model_redirect.php';
// Читаем настройки config для отправки письма
require_once(__DIR__.'/../lib/phpmailer/PHPMailerAutoload.php');
require_once (__DIR__.'/../lib/Session.php');
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
            $secret = '6LezGioTAAAAAISoHFhC2hEQHl1ZVftKqQB1Z_lg';
            $response = $_POST['g-recaptcha-response'];
            $remoteip = $_SERVER['REMOTE_ADDR'];
            $url = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$response&remoteip=$remoteip");
            $result_c = json_decode($url, TRUE);
//            var_dump($result_c['success']);

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
            if(empty($reg->getErrors()) and $result_c['success'] == 1){
                $reg->generateHash();
                $hash = $reg->generateCode(10);
//                var_dump($hash);
                echo !$db->query("INSERT INTO users (login, password, hash, email, date) VALUES ('{$reg->login}', '{$reg->password}', '{$hash}', '{$reg->email}', '{$reg->date}')") ? : 'Пользователь успешно создан! <br>На Ваш E-mail выслан код подтверждения!';
                Session::init();
                // Подготовка к отправке сообщения на почту
                $active = $db->query("SELECT id, email, hash FROM users WHERE login = '{$reg->login}'");
                $id_activ = $active->fetch_array();
                Session::set($login, $reg->login);

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
                    $mail->MsgHTML('Спасибо за регистрацию на нашем сайте DZ06.LOFTSCHOOL. Ваш логин: '.$reg->login.'  Для того чтобы войти в свой аккуант его нужно активировать.\n
Чтобы активировать ваш аккаунт, перейдите по ссылке:\n
http://dz06.loftschool/signup/activation/?login='.$reg->login.'&hash='.$hash.'   С уважением, Администрация сайта'); // Текст сообщения
                    $mail->Send();
//                    return 1;
                    echo "<br>На Ваш E-mail выслано письмо с cсылкой, для активации вашего аккуанта. <br><a href='/'>Главная страница</a></p>";
                    return 1;
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
        $login = $_GET['login'];
        $hash = $_GET['hash'];
        $db = Db::getInstance();

        if ($db){
            $active = $db->query("SELECT hash FROM users WHERE login = '{$login}'");
            $hash_activate = $active->fetch_array();
            if ($hash == $hash_activate['hash']){
                // код подтверждения совпадает - активируем
                echo !$db->query("UPDATE users SET activate = '1' WHERE login = '{$login}'");
                echo "Авторизован";
//                var_dump($login);
//                var_dump($hash);
                Model_Redirect::redirectToPage('login/');
            }
        } else
        {
            echo "Сессия не открыта";
            var_dump($_SESSION['id']);
            Session::destroy();
        }
    }
}