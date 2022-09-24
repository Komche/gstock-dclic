<?php
include 'connexion.php';
if (
    !empty($_POST['nom_article'])
    && !empty($_POST['categorie'])
    && !empty($_POST['quantite'])
    && !empty($_POST['prix_unitaire'])
    && !empty($_POST['date_fabrication'])
    && !empty($_POST['date_expiration'])
) {

$sql = "INSERT INTO $nom_base_de_donne.article(nom_article, categorie, quantite, prix_unitaire, date_fabrication, date_expiration)
        VALUES(?, ?, ?, ?, ?, ?)";
    $req = $connexion->prepare($sql);
    
    $req->execute(array(
        $_POST['nom_article'],  
        $_POST['categorie'],
        $_POST['quantite'],
        $_POST['prix_unitaire'],
        $_POST['date_fabrication'],
        $_POST['date_expiration']
    ));
    
    if ( $req->rowCount()!=0) {
        $_SESSION['message']['text'] = "article ajouté avec succès";
        $_SESSION['message']['type'] = "success";
    }else {
        $_SESSION['message']['text'] = "Une erreur s'est produite lors de l'ajout de l'article";
        $_SESSION['message']['type'] = "danger";
    }

} else {
    $_SESSION['message']['text'] ="Une information obligatoire non rensignée";
    $_SESSION['message']['type'] = "danger";
}

header('Location: ../vue/article.php');