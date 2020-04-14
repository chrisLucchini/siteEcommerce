<?php

class User{

    private $id_utilisateur;
    private $nom;
    private $prenom;
    private $password;
    private $pseudo;
    private $email_user;
    private $date_inscription;
    private $niveau;
    private $adresse = [];
    private $panier;

    public function setId_utilisateur($id_utilisateur){$this->id_utilisateur = $id_utilisateur;}
    public function setNom($nom){$this->nom = $nom;}
    public function setPrenom($prenom){$this->prenom = $prenom;}
    public function setPseudo($pseudo){$this->pseudo = $pseudo;}
    public function setEmail_user($email_user){$this->email_user = $email_user;}
    public function setAdresse($adresse){$this->adresse = $adresse;}
    public function setDate_inscription($date_inscription){$this->date_inscription = $date_inscription;}
    public function setNiveau($niveau){$this->niveau = $niveau;}
    public function setPassword($password){$this->password = $password;}
    public function setPanier($panier){$this->panier = $panier;}
    
    public function getId_utilisateur(){return $this->id_utilisateur;}
    public function getNom(){return $this->nom;}
    public function getPrenom(){return $this->prenom;}
    public function getPseudo(){return $this->pseudo;}
    public function getEmail_user(){return $this->email_user;}
    public function getAdresse(){return $this->adresse;}
    public function getDate_inscription(){return $this->date_inscription;}
    public function getNiveau(){return $this->niveau;}
    public function getPassword(){return $this->password;}
    public function getPanier(){return $this->panier;}

    public function initAdresse($adresse) {

        array_push($this->adresse, $adresse);

    }
   
}

// $u = new User();
// $u->registration("Christophe", "Lucchini", "christophelucchini@sfr.fr", "123");
// echo($u->verifyExist("christophelucchini@sfr.fr"));
