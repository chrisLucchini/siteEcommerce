<?php
require_once("config.inc.php");
require_once("Model/Autoloader.php");
require_once("View/View.php");
session_start();

$r = new Routeur();

if(isset($_SESSION['user']) && $_SESSION['user']->getNiveau() == "2") {
    
    
    $r->requeteAdmin();
    
}
else {

    $r->routerRequete();

}

