<?php
class Router
{
    public static function routing()
    {
        $url = filter_var($_SERVER["REQUEST_URI"],
        FILTER_SANITIZE_URL);
        $url = explode("?", $url)[0];
        $url = trim($url, "/");
        if(array_key_exists($url, ROUTES)){
            //j'inclus le fichier
            require "./controller/".ROUTES[$url]["controller"].".php";
            // j'instancie ma classe
            $controller = new (ROUTES[$url]["controller"])();
            // j'appelle la methode
            $controller ->{ROUTES[$url]["fonction"]}();
        }
        else{
            require 'view/404.php';
        }
    }
}






?>