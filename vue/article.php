<?php
include 'entete.php';

if (!empty($_GET['id'])) {
    $article = getArticle($_GET['id']);
}

$page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = 2; // Nombre d'articles par page
$offset = ($page - 1) * $limit;

?>
<div class="home-content">
    <div class="overview-boxes">
        <div class="box">
            <form action=" <?= !empty($_GET['id']) ?  "../model/modifArticle.php" : "../model/ajoutArticle.php" ?>" method="post" enctype="multipart/form-data">
                <label for="nom_article">Nom de l'article</label>
                <input value="<?= !empty($_GET['id']) ?  $article['nom_article'] : "" ?>" type="text" name="nom_article" id="nom_article" placeholder="Veuillez saisir le nom">
                <input value="<?= !empty($_GET['id']) ?  $article['id'] : "" ?>" type="hidden" name="id" id="id">

                <label for="id_categorie">Catégorie</label>
                <select name="id_categorie" id="id_categorie">
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

                <label for="images">Image</label>
                <input value="<?= !empty($_GET['id']) ?  $article['images'] : "" ?>" type="file" name="images" id="images">

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
        <div style="display: block;" class="box">
            <form action="" method="get">
                <table class="mtable">
                    <tr>
                        <th>Nom article</th>
                        <th>Catégorie</th>
                        <th>Quantité</th>
                        <th>Prix unitaire</th>
                        <th>Date fabrication</th>
                        <th>Date expiration</th>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" name="nom_article" id="nom_article" placeholder="Veuillez saisir le nom">
                        </td>
                        <td>
                            <select name="id_categorie" id="id_categorie">
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
                        </td>
                        <td>
                            <input type="number" name="quantite" id="quantite" placeholder="Veuillez saisir la quantité">
                        </td>
                        <td>
                            <input type="number" name="prix_unitaire" id="prix_unitaire" placeholder="Veuillez saisir le prix">
                        </td>
                        <td>
                            <input type="date" name="date_fabrication" id="date_fabrication">
                        </td>
                        <td>
                            <input type="date" name="date_expiration" id="date_expiration">
                        </td>
                    </tr>
                </table>
                <br>
                <button type="submit">Valider</button>
            </form>
            <br>
            <table class="mtable">
                <tr>
                    <th>Nom article</th>
                    <th>Catégorie</th>
                    <th>Quantité</th>
                    <th>Prix unitaire</th>
                    <th>Date fabrication</th>
                    <th>Date expiration</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
                <?php
                $total_articles = 0;
                $total_pages = 0;
                if (!empty($_GET['s'])) {
                    $articles = getArticle(null, $_GET, $limit, $offset);

                    $count = countArticle($_GET);
                    $total_articles = $count['total'];
                    $total_pages = ceil($total_articles / $limit);
                } else {
                    $articles = getArticle(null, null, $limit, $offset);

                    $count = countArticle(null);
                    $total_articles = $count['total'];
                    $total_pages = ceil($total_articles / $limit);
                }



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
                            <td><img width="100" height="100" src="<?= $value['images'] ?>" alt="<?= $value['nom_article'] ?>"></td>
                            <td><a href="?id=<?= $value['id'] ?>"><i class='bx bx-edit-alt'></i></a></td>
                        </tr>
                <?php

                    }
                }
                ?>
            </table>
            <?php

            echo "<div class='pagination'>";
            // $active = "";
            // echo "<pre>";
            // var_dump($total_pages, $limit, $total_articles);
            // echo "</pre>";
            // Lien vers la page précédente
            if ($page > 1) {
                $prev_page = $page - 1;
                echo "<a href='?page=$prev_page'>&laquo; Précédent</a> ";
            }
            
            for ($i = 1; $i <= $total_pages; $i++) {
                
                if($i==$page) $active = "active"; else $active = "";
                echo "<a class='$active' href='?page=$i'>$i</a> ";
            }

            

            // Lien vers la page suivante
            if ($page < $total_pages) {
                $next_page = $page + 1;
                echo "<a href='?page=$next_page'>Suivant &raquo;</a> ";
            }
            echo "</div>";

            ?>
        </div>
    </div>

</div>
</section>

<?php
include 'pied.php';
?>