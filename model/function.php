<?php
include 'connexion.php';

function getArticle($id = null)
{
    if (!empty($id)) {
        $sql = "SELECT * FROM article WHERE id=?";

        $req = $GLOBALS['connexion']->prepare($sql);

        $req->execute(array($id));

        return $req->fetch();
    } else {
        $sql = "SELECT * FROM article";

        $req = $GLOBALS['connexion']->prepare($sql);

        $req->execute();

        return $req->fetchAll();
    }
}

function getClient($id = null)
{
    if (!empty($id)) {
        $sql = "SELECT * FROM client WHERE id=?";

        $req = $GLOBALS['connexion']->prepare($sql);

        $req->execute(array($id));

        return $req->fetch();
    } else {
        $sql = "SELECT * FROM client";

        $req = $GLOBALS['connexion']->prepare($sql);

        $req->execute();

        return $req->fetchAll();
    }
}

function getVente($id = null)
{
    if (!empty($id)) {
        $sql = "SELECT nom_article, nom, prenom, v.quantite, prix, date_vente, v.id, prix_unitaire, adresse, telephone
        FROM client AS c, vente AS v, article AS a WHERE v.id_article=a.id AND v.id_client=c.id AND v.id=? AND etat=?";

        $req = $GLOBALS['connexion']->prepare($sql);

        $req->execute(array($id, 1));

        return $req->fetch();
    } else {
        $sql = "SELECT nom_article, nom, prenom, v.quantite, prix, date_vente, v.id, a.id AS idArticle
        FROM client AS c, vente AS v, article AS a WHERE v.id_article=a.id AND v.id_client=c.id AND etat=?";

        $req = $GLOBALS['connexion']->prepare($sql);

        $req->execute(array(1));

        return $req->fetchAll();
    }
}


function getFournisseur($id = null)
{
    if (!empty($id)) {
        $sql = "SELECT * FROM fournisseur WHERE id=?";

        $req = $GLOBALS['connexion']->prepare($sql);

        $req->execute(array($id));

        return $req->fetch();
    } else {
        $sql = "SELECT * FROM fournisseur";

        $req = $GLOBALS['connexion']->prepare($sql);

        $req->execute();

        return $req->fetchAll();
    }
}

function getCommande($id = null)
{
    if (!empty($id)) {
        $sql = "SELECT nom_article, nom, prenom, co.quantite, prix, date_commande, co.id, prix_unitaire, adresse, telephone
        FROM fournisseur AS f, commande AS co, article AS a WHERE co.id_article=a.id AND co.id_fournisseur=f.id AND co.id=?";

        $req = $GLOBALS['connexion']->prepare($sql);

        $req->execute(array($id));

        return $req->fetch();
    } else {
        $sql = "SELECT nom_article, nom, prenom, co.quantite, prix, date_commande, co.id, a.id AS idArticle
        FROM fournisseur AS f, commande AS co, article AS a WHERE co.id_article=a.id AND co.id_fournisseur=f.id";

        $req = $GLOBALS['connexion']->prepare($sql);

        $req->execute();

        return $req->fetchAll();
    }
}

function getAllCommande()
{
    $sql = "SELECT COUNT(*) AS nbre FROM commande";

    $req = $GLOBALS['connexion']->prepare($sql);

    $req->execute();

    return $req->fetch();
}

function getAllVente()
{
    $sql = "SELECT COUNT(*) AS nbre FROM vente WHERE etat=?";

    $req = $GLOBALS['connexion']->prepare($sql);

    $req->execute(array(1));

    return $req->fetch();
}

function getAllArticle()
{
    $sql = "SELECT COUNT(*) AS nbre FROM article";

    $req = $GLOBALS['connexion']->prepare($sql);

    $req->execute();

    return $req->fetch();
}

function getCA()
{
    $sql = "SELECT SUM(prix) AS prix FROM vente";

    $req = $GLOBALS['connexion']->prepare($sql);

    $req->execute();

    return $req->fetch();
}

function getLastVente()
{

    $sql = "SELECT nom_article, nom, prenom, v.quantite, prix, date_vente, v.id, a.id AS idArticle
        FROM client AS c, vente AS v, article AS a WHERE v.id_article=a.id AND v.id_client=c.id AND etat=? 
        ORDER BY date_vente DESC LIMIT 10";

    $req = $GLOBALS['connexion']->prepare($sql);

    $req->execute(array(1));

    return $req->fetchAll();
}

function getMostVente()
{

    $sql = "SELECT nom_article, SUM(prix) AS prix
        FROM client AS c, vente AS v, article AS a WHERE v.id_article=a.id AND v.id_client=c.id AND etat=? 
        GROUP BY a.id
        ORDER BY SUM(prix) DESC LIMIT 10";

    $req = $GLOBALS['connexion']->prepare($sql);

    $req->execute(array(1));

    return $req->fetchAll();
}
