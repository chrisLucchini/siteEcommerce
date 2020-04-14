<?php

class Avis{

    private $id_avis;
    private $id_utilisateur;
    private $id_produit;
    private $note;
    private $titre;
    private $texte_avis;
 

    public function __construct($data = null) {

        if(is_array($data)) {

            $this->hydrate($data);

        }
    }

    public function hydrate($donnees)
    {
        foreach ($donnees as $key => $value)
        {
            // On récupère le nom du setter correspondant à l'attribut.
            $method = 'set'.ucfirst($key);
                
            // Si le setter correspondant existe.
            if (method_exists($this, $method))
            {
            // On appelle le setter.
            $this->$method($value);
            }
        }
    }

    

    /**
     * Get the value of id_avis
     */ 
    public function getId_avis()
    {
        return $this->id_avis;
    }

    /**
     * Get the value of id_utilisateur
     */ 
    public function getId_utilisateur()
    {
        return $this->id_utilisateur;
    }

    /**
     * Get the value of id_produit
     */ 
    public function getId_produit()
    {
        return $this->id_produit;
    }

    /**
     * Get the value of note
     */ 
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Get the value of titre
     */ 
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Get the value of texte_avis
     */ 
    public function getTexte_avis()
    {
        return $this->texte_avis;
    }

    /**
     * Set the value of id_avis
     *
     * @return  self
     */ 
    public function setId_avis($id_avis)
    {
        $this->id_avis = $id_avis;

        return $this;
    }

    /**
     * Set the value of id_utilisateur
     *
     * @return  self
     */ 
    public function setId_utilisateur($id_utilisateur)
    {
        $this->id_utilisateur = $id_utilisateur;

        return $this;
    }

    /**
     * Set the value of id_produit
     *
     * @return  self
     */ 
    public function setId_produit($id_produit)
    {
        $this->id_produit = $id_produit;

        return $this;
    }

    /**
     * Set the value of note
     *
     * @return  self
     */ 
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Set the value of titre
     *
     * @return  self
     */ 
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Set the value of texte_avis
     *
     * @return  self
     */ 
    public function setTexte_avis($texte_avis)
    {
        $this->texte_avis = $texte_avis;

        return $this;
    }
}