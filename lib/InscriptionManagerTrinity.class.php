<?php
class InscriptionManagerTrinity extends InscriptionManager
{
    private $_db; // Instance de PDO
    
    // Fonction appelé dès l'instanciation de l'objet Inscription.
    public function __construct($db)
    {
        $this->setDb($db);
    }
    
    // Fonction qui regarde si le pseudo est déjà pris.
    public function existePseudo($pseudo)
    {
        if (is_string($pseudo))
        {
            $req = $this->_db->prepare("SELECT COUNT(*) FROM account WHERE username = :pseudo");
            $req->execute(array(":pseudo" => $pseudo));
            
            return (bool) $req->fetchColumn();
        }
    }
    
    // Fonction qui regarde si l'adresse email est déjà prise.
    public function existeEmail($email)
    {
        if (is_string($email))
        {
            $req = $this->_db->prepare("SELECT COUNT(*) FROM account WHERE email = :email");
            $req->execute(array(":email" => $email));
            
            return (bool) $req->fetchColumn();
        }
    }
    
    // Fonction qui inscrit le compte dans la base de données.
    public function add(Inscription $compte, $extenssion)
    {
        $req = $this->_db->prepare("INSERT INTO account (username, sha_pass_hash, email, expansion, last_ip) VALUES (:username, :sha_pass_hash, :email, :expansion, :last_ip)");
        
        $req->bindValue(":username", $compte->pseudo(), PDO::PARAM_STR);
        $req->bindValue(":sha_pass_hash", $compte->SHA1Compte(), PDO::PARAM_STR);
        $req->bindValue(":email", $compte->email(), PDO::PARAM_STR);
        $req->bindValue(":expansion", $extenssion, PDO::PARAM_INT);
        $req->bindValue(":last_ip", $compte->ip(), PDO::PARAM_STR);
        
        $req->execute();
        
        $req2 = $this->_db->prepare("INSERT INTO account_access (id, gmlevel) VALUES (?, 0)");
        $req2->execute(array($this->_db->lastInsertId()));
    }
    
    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }
}