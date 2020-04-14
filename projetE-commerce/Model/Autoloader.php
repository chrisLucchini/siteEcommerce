<?php
class Autoloader
{
    public static function ModelRegister()
    {
        spl_autoload_register(function($className){

            $file = "C:\\wamp\\www\\dev_2019\\siteEcommerce\\projetE-commerce\\Model\\".$className.'.php';
            if(file_exists($file)) {

                include $file;
            }
        });
    }
    public static function ControllerRegister()
    {
        spl_autoload_register(function($className){

            $file = "C:\\wamp\\www\\dev_2019\\siteEcommerce\\projetE-commerce\\Controller\\".$className.'.php';
            if(file_exists($file)) {

                include $file;
            }
        });
    }
}
Autoloader::ModelRegister();
Autoloader::ControllerRegister();