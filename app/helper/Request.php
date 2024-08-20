<?php

namespace app\helper;


class Request
{
    //retornar tipo de requisição chamada
    public static function get(){
        return strtolower($_SERVER['REQUEST_METHOD']);
    }
}