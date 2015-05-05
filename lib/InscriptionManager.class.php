<?php
abstract class InscriptionManager
{
    abstract public function existePseudo($pseudo);
    
    abstract public function existeEmail($email);
    
    abstract public function add(Inscription $compte, $extenssion);
}