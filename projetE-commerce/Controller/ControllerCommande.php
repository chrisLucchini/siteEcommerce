<?php

class ControllerCommande {

    /**
     * On recupere toute les commandes de l'utilisateur
     */
    public function controlCommande() {

        $commandeBdd = LigneCommandeModel::get_instance();

        $commandes = $commandeBdd->getCommande($_SESSION['user']->getId_utilisateur());

        return $commandes;
    }
}