<?php
namespace Framework;
class Router{
    public static function redirect($togo){
        header("Location: {$togo}");
        die;
    }
}