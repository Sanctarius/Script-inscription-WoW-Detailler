<?php
class DBFactory
{
    const CONNEXION_FAIL = 1;   // Constante renvoyé si la connexion MySQL ne fonctionne pas.
    
    // Fonction de connexion au serveur MySQL.
    public static function getMysqlConnexionWithPDO($host, $dbname)
    {
        // Variable global.
        global $config_global, $config_options;
        
        // On tente de se connecter au serveur MySQL.
        try
        {
            $db = new PDO("mysql:host=".$host.";dbname=".$dbname, $config_global["nomDeCompteMySQL"], $config_global["motDePasseMySQL"]);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // On retourne l'instance PDO.
            return $db;
        }
        // Sinon.
        catch (PDOException $erreur)
        {
            // Si le mode débug est activé.
            if ($config_options["modeDebug"] === true)
            {
                // On affiche l'erreur.
                echo "<p class=\"erreur\">
                La connexion au serveur MySQL n'a pas été faite.<br />
                Message d'erreur: ".$erreur->getMessage()."
                </p>";
            }
            
            // On dit que le service n'est pas disponnible pour le moment.
            echo "<p class=\"info\">Ce service est momentanément indisponible. Veuillez nous excuser pour la gêne occasionnée.</p>";
            
            // On retourne la constante CONNEXION_FAIL.
            return self::CONNEXION_FAIL;
        }
    }
}