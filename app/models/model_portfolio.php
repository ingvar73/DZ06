<?php

class Model_Portfolio extends Model {

    public function get_data()
    {
        return array(
            array(
                "year" => "2014",
                "site" => "http://yandex.ru/",
                "name" => "Мой первый сайт",
                "description" => "Сайт который я сделал впервые"
            ),
            array(
                "year" => "2015",
                "site" => "http://google.com/",
                "name" => "Мой второй сайт",
                "description" => "Сайт который я сделал второй раз"
            ),
            array(
                "year" => "2016",
                "site" => "http://mail.ru/",
                "name" => "Мой третий сайт",
                "description" => "Сайт который я сделал третий раз"
            )
        );
    }

}