<?php
include 'entete.php';

if (!empty($_GET['id'])) {
    $article = getArticle($_GET['id']);
}

?>
<div class="home-content">
    <div class="overview-boxes">
        <div class="box">
            <form action=" <?= !empty($_GET['id']) ?  "../model/modifArticle.php" : "../model/ajoutArticle.php" ?>" method="post">
                <label for="nom_article">Nom de l'article</label>
                <input value="<?= !empty($_GET['id']) ?  $article['nom_article'] : "" ?>" type="text" name="nom_article" id="nom_article" placeholder="Veuillez saisir le nom">
                <input value="<?= !empty($_GET['id']) ?  $article['id'] : "" ?>" type="hidden" name="id" id="id">

                <label for="categorie">Catégorie</label>
                <select name="categorie" id="categorie">
                <option value="">--Choisir une catégorie--</option>
                    <?php

                    $categories = getCategorie();
                    if (is_array($categories) && !empty($categories)) {
                        foreach ($categories as $key => $value) {
                            ?>
                            <option <?= !empty($_GET['id']) && $article['id_categorie'] == $value['id'] ?  "selected" : "" ?> value="<?= $value['id'] ?>"><?= $value['libelle_categorie'] ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>

                <label for="quantite">Quantité</label>
                <input value="<?= !empty($_GET['id']) ?  $article['quantite'] : "" ?>" type="number" name="quantite" id="quantite" placeholder="Veuillez saisir la quantité">

                <label for="prix_unitaire">Prix unitaire</label>
                <input value="<?= !empty($_GET['id']) ?  $article['prix_unitaire'] : "" ?>" type="number" name="prix_unitaire" id="prix_unitaire" placeholder="Veuillez saisir le prix">

                <label for="date_fabrication">Date de fabrication</label>
                <input value="<?= !empty($_GET['id']) ?  $article['date_fabrication'] : "" ?>" type="datetime-local" name="date_fabrication" id="date_fabrication">

                <label for="date_expiration">Date d'expiration</label>
                <input value="<?= !empty($_GET['id']) ?  $article['date_expiration'] : "" ?>" type="datetime-local" name="date_expiration" id="date_expiration">

                <button type="submit">Valider</button>

                <?php
                if (!empty($_SESSION['message']['text'])) {
                ?>
                    <div class="alert <?= $_SESSION['message']['type'] ?>">
                        <?= $_SESSION['message']['text'] ?>
                    </div>
                <?php
                }
                ?>
            </form>

        </div>
        <div class="box">
            <table class="mtable">
                <tr>
                    <th>Nom article</th>
                    <th>Catégorie</th>
                    <th>Quantité</th>
                    <th>Prix unitaire</th>
                    <th>Date fabrication</th>
                    <th>Date expiration</th>
                    <th>Action</th>
                </tr>
                <?php
                $articles = getArticle();

                if (!empty($articles) && is_array($articles)) {
                    foreach ($articles as $key => $value) {
                ?>
                        <tr>
                            <td><?= $value['nom_article'] ?></td>
                            <td><?= $value['libelle_categorie'] ?></td>
                            <td><?= $value['quantite'] ?></td>
                            <td><?= $value['prix_unitaire'] ?></td>
                            <td><?= date('d/m/Y H:i:s', strtotime($value['date_fabrication'])) ?></td>
                            <td><?= date('d/m/Y H:i:s', strtotime($value['date_expiration'])) ?></td>
                            <td><a href="?id=<?= $value['id'] ?>"><i class='bx bx-edit-alt'></i></a></td>
                        </tr>
                <?php

                    }
                }
                ?>
            </table>
        </div>
    </div>

</div>
</section>

<?php
include 'pied.php';
?>