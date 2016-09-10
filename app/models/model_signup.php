<?php

/**
 * Created by PhpStorm.
 * User: ingvar73
 * Date: 10.09.2016
 * Time: 12:22
 */
class Model_Signup extends Model
{
    public $confirm_password;
    private $err=[];

    const H_PASSWORD_PATTERN = '/(?=^.{8,32}$)((?=.*\d)|(?=.*\W+))(?|[.\n])(?=.*[A-Z])(?=.[a-z]).*S/';
    const M_PASSWORD_PATTERN = '/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,30}/';
    const LOGIN_PATTERN = '/^[a-zA-Z][a-zA-Z0-9-_\.]{1,20}$/';
    const EMAIL_PATTERN = '/@/';

    public function __construct($login, $password, $confirm_password, $email)
    {
        $this->login = $login;
        $this->password = $password;
        $this->confirm_password = $confirm_password;
        $this->email = $email;
        $this->date = date('d:m:y');
    }

    public function regex ($pattern, $field, $err){
        preg_match($pattern, $field) ? : $this->err[] = $err;
    }

    public function len ($min, $max, $variable, $err){
        !(strlen($variable) > $max || strlen($variable) < $min) ? : $this->err[] = $err;
    }

    public function quality ($one, $two, $err){
        $one == $two ? : $this->err[] = $err;
    }

    public function unique(array $row, $err){
        array_shift($row) == 0 ? : $this->err[] = $err;
    }

    public function getErrors (){
        return $this->err;
    }

    public function generateSalt ($int){
        $chars = 'qwertyuiopasdfghjklzxcvbnm0123456789QWERTYUIOPASDFGHJKLZXCVBNM<>?;][\/-=)(+';
        $size = strlen($chars) - 1;
        $salt = '';
        while ($int--){
            $salt .= $chars[rand(0, $size)];
        }
        return $salt;
    }

    public function generateHash ($algo = PASSWORD_DEFAULT, array $options = null) {
        !is_null($options) ? : $options = [
            'salt' => $this->generateSalt(22),
            'cost' => 10
        ];
        $this->password = password_hash($this->password, $algo, $options);
    }
}