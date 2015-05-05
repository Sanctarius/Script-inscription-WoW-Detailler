<?php
class Inscription
{
    protected $_erreurs = [],
              $_pseudo,
              $_motDePasse,
              $_motDePasse2,
              $_email,
              $_captcha,
              $_captchaSession,
              $_cgu,
              $_ip;
    
    // Constantes relatives aux erreurs possibles rencontrées lors de l'exécution de la méthode.
    const PSEUDO_INVALIDE = 1;
    const MOT_DE_PASSE_INVALIDE = 2;
    const MOT_DE_PASSE_2_INVALIDE = 3;
    const EMAIL_INVALIDE = 4;
    const CAPTCHA_INVALIDE = 5;
    const CAPTCHA_SESSION_INVALIDE = 6;
    const CGU_INVALIDE = 7;
    const IP_INVALIDE = 8;
    
    // Fonction appelé dès l'instanciation de l'objet Inscription.
    public function __construct($donnees = [])
    {
        if (!empty($donnees)) // Si on a spécifié des valeurs, alors on hydrate l'objet.
        {
            $this->hydrate($donnees);
        }
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
    
    // Fonction qui regarde si les variables ne sont pas vide.
    public function isValide()
    {
        return !(empty($this->_pseudo) || empty($this->_motDePasse) || empty($this->_motDePasse2) || empty($this->_email) || empty($this->_captcha) || empty($this->_captchaSession) || empty($this->_cgu) || empty($this->_ip));
    }
    
    // Fonction qui regarde si les deux mots de passe sont identiques.
    public function motDePasseValide()
    {
        return (bool) ($this->_motDePasse === $this->_motDePasse2);
    }
    
    // Fonction qui regarde si l'adresse email est valide.
    public function emailValide()
    {
        return (bool) (filter_var($this->_email, FILTER_VALIDATE_EMAIL));
    }
    
    // Fonction qui regarde si le captcha est valide.
    public function captchaValide()
    {
        return (bool) ($this->_captcha === $this->_captchaSession);
    }
    
    // Fonction qui fait chiffre le mot de passe.
    public function SHA1Compte()
    {
        return SHA1(strtoupper($this->_pseudo) . ":" . strtoupper($this->_motDePasse));
    }
    
    // SETTERS //
    
    public function setPseudo($pseudo)
    {
        if (!is_string($pseudo) || empty($pseudo) || strlen($pseudo) < 3 || strlen($pseudo) > 13)
        {
            $this->_erreurs[] = self::PSEUDO_INVALIDE;
        }
        else
        {
            $this->_pseudo = $pseudo;
        }
    }
    
    public function setMotDePasse($motDePasse)
    {
        if (!is_string($motDePasse) || empty($motDePasse) || strlen($motDePasse) < 3 || strlen($motDePasse) > 13)
        {
            $this->_erreurs[] = self::MOT_DE_PASSE_INVALIDE;
        }
        else
        {
            $this->_motDePasse = $motDePasse;
        }
    }
    
    public function setMotDePasse2($motDePasse2)
    {
        if (!is_string($motDePasse2) || empty($motDePasse2) || strlen($motDePasse2) < 3 || strlen($motDePasse2) > 13)
        {
            $this->_erreurs[] = self::MOT_DE_PASSE_2_INVALIDE;
        }
        else
        {
            $this->_motDePasse2 = $motDePasse2;
        }
    }
    
    public function setEmail($email)
    {
        if (!is_string($email) || empty($email))
        {
            $this->_erreurs[] = self::EMAIL_INVALIDE;
        }
        else
        {
            $this->_email = $email;
        }
    }
    
    public function setCaptcha($captcha)
    {
        if (!is_string($captcha) || empty($captcha))
        {
            $this->_erreurs[] = self::CAPTCHA_INVALIDE;
        }
        else
        {
            $this->_captcha = $captcha;
        }
    }
    
    public function setCaptchaSession($captchaSession)
    {
        if (!is_string($captchaSession) || empty($captchaSession))
        {
            $this->_erreurs[] = self::CAPTCHA_SESSION_INVALIDE;
        }
        else
        {
            $this->_captchaSession = $captchaSession;
        }
    }
    
    public function setCgu($cgu)
    {
        if (!is_string($cgu) || empty($cgu))
        {
            $this->_erreurs[] = self::CGU_INVALIDE;
        }
        else
        {
            $this->_cgu = $cgu;
        }
    }
    
    public function setIp($ip)
    {
        if (empty($ip))
        {
            $this->_erreurs[] = self::IP_INVALIDE;
        }
        else
        {
            $this->_ip = $ip;
        }
    }
    
    // GETTERS //
    
    public function erreurs()
    {
        return $this->_erreurs;
    }
    
    public function pseudo()
    {
        return $this->_pseudo;
    }
    
    public function motDePasse()
    {
        return $this->_motDePasse;
    }
    
    public function motDePasse2()
    {
        return $this->_motDePasse2;
    }
    
    public function email()
    {
        return $this->_email;
    }
    
    public function captcha()
    {
        return $this->_captcha;
    }
    
    public function captchaSession()
    {
        return $this->_captchaSession;
    }
    
    public function cgu()
    {
        return $this->_cgu;
    }
    
    public function ip()
    {
        return $this->_ip;
    }
}