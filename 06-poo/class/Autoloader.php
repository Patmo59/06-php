<?php
class Autoloader
{
    public static function register()
    {
        // Cette fonction ser lancée à chaque qfois qu'on tentera d'instancier une classe
        spl_autoload_register(function($class)
    {
        $file = str_replace("\\", DIRECTORY_SEPARATOR, $class).".php";
        if(file_exists($file))
        {
            require $file;
            return true;
        }
        return false;
    });
    }
}
?>