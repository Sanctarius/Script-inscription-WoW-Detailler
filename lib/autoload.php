<?php
// Fonction qui inclu automatiquement les fichiers correspondant à l'instanciation d'une classe.
function autoload($classname)
{
    if (file_exists($file = __DIR__ . '/' . $classname . '.class.php'))
    {
        require $file;
    }
}

spl_autoload_register('autoload');