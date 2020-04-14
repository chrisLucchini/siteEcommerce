<?php
require_once("config.inc.php");
class Autoloader
{
    public static function ModelRegister()
    {
        spl_autoload_register(function($className){

            $file = PATH_SITE."Model/".$className.".php";
            if(file_exists($file)) {

                include $file;
            }
        });
    }
    public static function ControllerRegister()
    {
        spl_autoload_register(function($className){

            $file = PATH_SITE."Controller/".$className.".php";
            if(file_exists($file)) {

                include $file;
            }
        });
    }
}
Autoloader::ModelRegister();
Autoloader::ControllerRegister();