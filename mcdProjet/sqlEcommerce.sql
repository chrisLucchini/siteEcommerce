#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: Utilisateur
#------------------------------------------------------------

CREATE TABLE Utilisateur(
        id_utilisateur   Int  Auto_increment  NOT NULL ,
        nom              Varchar (50) NOT NULL ,
        prenom           Varchar (50) NOT NULL ,
        pseudo           Varchar (50) NOT NULL ,
        mail_utilisateur Varchar (255) NOT NULL ,
        pass_utilisateur Text NOT NULL ,
        date_inscription Datetime NOT NULL
	,CONSTRAINT Utilisateur_PK PRIMARY KEY (id_utilisateur)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: produit
#------------------------------------------------------------

CREATE TABLE produit(
        id_produit  Int  Auto_increment  NOT NULL ,
        marque      Varchar (55) NOT NULL ,
        modele      Varchar (55) NOT NULL ,
        designation Text NOT NULL ,
        categorie   Varchar (55) NOT NULL ,
        prix        Float NOT NULL
	,CONSTRAINT produit_PK PRIMARY KEY (id_produit)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: image
#------------------------------------------------------------

CREATE TABLE image(
        id_image   Int  Auto_increment  NOT NULL ,
        source     Text NOT NULL ,
        type       Varchar (55) NOT NULL ,
        id_produit Int NOT NULL
	,CONSTRAINT image_PK PRIMARY KEY (id_image)

	,CONSTRAINT image_produit_FK FOREIGN KEY (id_produit) REFERENCES produit(id_produit)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: caracteristique
#------------------------------------------------------------

CREATE TABLE caracteristique(
        id_carac                  Int  Auto_increment  NOT NULL ,
        type                      Varchar (55) NOT NULL ,
        valeur                    Varchar (55) NOT NULL ,
        typevaleur                Varchar (55) NOT NULL ,
        categorie_produit         Varchar (55) NOT NULL ,
        categorie_caracteristique Varchar (55) NOT NULL
	,CONSTRAINT caracteristique_PK PRIMARY KEY (id_carac)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: adresse
#------------------------------------------------------------

CREATE TABLE adresse(
        id_adresse     Int  Auto_increment  NOT NULL ,
        ville          Varchar (55) NOT NULL ,
        num_rue        Int NOT NULL ,
        nom_rue        Text NOT NULL ,
        code_postal    Int NOT NULL ,
        id_utilisateur Int NOT NULL
	,CONSTRAINT adresse_PK PRIMARY KEY (id_adresse)

	,CONSTRAINT adresse_Utilisateur_FK FOREIGN KEY (id_utilisateur) REFERENCES Utilisateur(id_utilisateur)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: commande
#------------------------------------------------------------

CREATE TABLE commande(
        id_commande         Int  Auto_increment  NOT NULL ,
        tva                 Float NOT NULL ,
        montant_ht          Float NOT NULL ,
        montant_ttc         Float NOT NULL ,
        date_commande       Datetime NOT NULL ,
        id_utilisateur      Int NOT NULL ,
        id_adresse          Int NOT NULL ,
        id_adresse_Facturer Int NOT NULL
	,CONSTRAINT commande_PK PRIMARY KEY (id_commande)

	,CONSTRAINT commande_Utilisateur_FK FOREIGN KEY (id_utilisateur) REFERENCES Utilisateur(id_utilisateur)
	,CONSTRAINT commande_adresse0_FK FOREIGN KEY (id_adresse) REFERENCES adresse(id_adresse)
	,CONSTRAINT commande_adresse1_FK FOREIGN KEY (id_adresse_Facturer) REFERENCES adresse(id_adresse)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: lignecommande
#------------------------------------------------------------

CREATE TABLE lignecommande(
        id_commande Int NOT NULL ,
        id_produit  Int NOT NULL ,
        quantite    Int NOT NULL
	,CONSTRAINT lignecommande_PK PRIMARY KEY (id_commande,id_produit)

	,CONSTRAINT lignecommande_commande_FK FOREIGN KEY (id_commande) REFERENCES commande(id_commande)
	,CONSTRAINT lignecommande_produit0_FK FOREIGN KEY (id_produit) REFERENCES produit(id_produit)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: caracteristiqueProduit
#------------------------------------------------------------

CREATE TABLE caracteristiqueProduit(
        id_carac   Int NOT NULL ,
        id_produit Int NOT NULL
	,CONSTRAINT caracteristiqueProduit_PK PRIMARY KEY (id_carac,id_produit)

	,CONSTRAINT caracteristiqueProduit_caracteristique_FK FOREIGN KEY (id_carac) REFERENCES caracteristique(id_carac)
	,CONSTRAINT caracteristiqueProduit_produit0_FK FOREIGN KEY (id_produit) REFERENCES produit(id_produit)
)ENGINE=InnoDB;

