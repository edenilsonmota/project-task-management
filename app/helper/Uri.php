<?php

namespace app\helper;


class Uri{
    //retorna a uri referente as requisições
    public static function get($type)
    {   
        $uri = parse_url($_SERVER['REQUEST_URI']);
        return $uri[$type];
    }
}
