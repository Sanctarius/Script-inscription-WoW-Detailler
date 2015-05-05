<?php
#######################################################################################################################
## 
## Fichier de configuration du script. (Non modifié)
##
## == CONFIGURATION GENERAL DU SCRIPT ==
$config_global = array(
    "hoteMySQL"         => "localhost",     // Adresse où se trouve le serveur MySQL.
    "nomDeCompteMySQL"  => "root",          // Nom de compte du serveur MySQL.
    "motDePasseMySQL"   => "",              // Mot de passe du serveur MySQL.
    
    "bddCompte"         => "auth",          // Base de données des comptes.
    
    "hoteCore"          => "localhost",     // Adresse où se trouve le Core du serveur.
    "portCore"          => "8085",          // Port de communication du Core.
    "portSoap"          => "7878",          // Port de communication de la fonction SOAP.
    "nomDeCompteSoap"   => "",              // Le nom de compte du SOAP. (Doit être utilisateur de console, donc tout pouvoir, level 4)
    "motDePasseSoap"    => "",              // Le mot de passe du compte SOAP.
    
    "emulateur"         => 1,               // Emulateur du serveur.
                                            // 1 = TrinityCore, 2 = MaNGOS
    "extenssion"        => 2,               // Extenssion de jeu du serveur.
                                            // 0 = Vanilla, 1 = BC, 2 = Wotlk, 3 = Cataclysm, 4 = MoP, 5 = WoD
);
##
## == CONFIGURATION DES OPTIONS DU SCRIPT ==
$config_options = array(
    "modeDebug"         => false,           // Cette option sert à activer le mode débug. Celui-ci fera apparaître toutes les erreurs. (Utile lors de la configuration)
                                            // true = activé, false = désactivé.
    
    "captcha"           => true,            // Cette option sert à activer le captcha. Celui-ci lutte contre les robots. (conseillé)
                                            // true = activé, false = désactivé.
    
    "cgu"               => false,           // Cette option sert à activer la case des conditions générales d'utilisation. (facultatif)
                                            // true = activé, false = désactivé.
    "lienCgu"           => "#",             // Le lien de votre page CGU.
    
    "soap"              => false,           // Cette option sert à activer le SOAP. Celui-ci fait en sorte d'inscrire les membres par le Core en faisans des commandes. (Conseillé)
                                            // true = activé, false = désactivé.
);
##
#######################################################################################################################