<?php
include 'connexion.php';

if (
    !empty($_GET['idVente']) &&
    !empty($_GET['idArticle']) &&
    !empty($_GET['quantite'])
) {

    $sql = "UPDATE vente SET etat=? WHERE id=?";
    $req = $connexion->prepare($sql);
    $req->execute(array(0,$_GET['idVente']));

    if ($req->rowCount() != 0) {
        $sql = "UPDATE article SET quantite=quantite+? WHERE id=?";
        $req = $connexion->prepare($sql);
        $req->execute(array($_GET['quantite'],$_GET['idArticle']));

    }
}
header('Location: ../vue/vente.php');