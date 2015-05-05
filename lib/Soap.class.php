<?php
class Soap
{
    protected $_ipSoap,
              $_portSoap,
              $_nomDeCompteSoap,
              $_motDePasseSoap,
              $_identifiantSoap,
              $_soap,
              $_erreurs = [];
    
    const SOAP_COMMANDE_FAIL = 1;   // Constante renvoyé si la connexion SOAP ne fonctionne pas.
    
    // Fonction appelé dès l'instanciation de l'objet Inscription.
    public function __construct($donnees = [])
    {
        if (!empty($donnees)) // Si on a spécifié des valeurs, alors on hydrate l'objet.
        {
            $this->hydrate($donnees);
        }
        
        $this->Soap();
    }
    
    // Fonction qui "hydrate" les variables définies plus haut gràçe au Setters.
    public function hydrate($donnees)
    {
        foreach ($donnees as $attribut => $valeur)
        {
            $methode = 'set'.ucfirst($attribut);
            
            if (is_callable([$this, $methode]))
            {
                $this->$methode($valeur);
            }
        }
    }
    
    // Fonction qui met en forme la requette de connexion Soap.
    private function Soap()
    {
        $this->_soap = new SoapClient(NULL, array(
            "location" => "http://".$this->_ipSoap.":".$this->_portSoap."/",
            "uri" => "urn:".$this->_identifiantSoap,
            "style" => SOAP_RPC,
            "login" => $this->_nomDeCompteSoap,
            "password" => $this->_motDePasseSoap,
            "keep_alive" => false
        ));
    }
    
    // Fonction qui execute une commande données par le Soap.
    public function commande($commande)
    {
        // Variable global.
        global $config_options;
        
        // On essaie d'éxécuter la commande.
        try
        {
            $this->_soap->executeCommand(new SoapParam($commande, 'command'));
        }
        // Si ça fonctionne pas.
        catch (Exception $erreur)
        {
            // Si le mode débug est activé.
            if ($config_options["modeDebug"] === true)
            {
                // On affiche l'erreur.
                echo "<p class=\"erreur\">
                La commande SOAP n'a pas été faite.<br />
                Message d'erreur: ".$erreur->getMessage()."
                </p>";
            }
            
            $this->_erreurs[] = self::SOAP_COMMANDE_FAIL;
        }
    }
    
    // SETTERS //
    
    private function setIpSoap($ipSoap)
    {
        $this->_ipSoap = $ipSoap;
    }
    
    private function setPortSoap($portSoap)
    {
        $this->_portSoap = $portSoap;
    }
    
    private function setNomDeCompteSoap($nomDeCompteSoap)
    {
        $this->_nomDeCompteSoap = $nomDeCompteSoap;
    }
    
    private function setMotDePasseSoap($motDePasseSoap)
    {
        $this->_motDePasseSoap = $motDePasseSoap;
    }
    
    private function setIdentifiantSoap($identifiantSoap)
    {
        $this->_identifiantSoap = $identifiantSoap;
    }
    
    // GETTERS //
    
    public function erreurs()
    {
        return $this->_erreurs;
    }
}