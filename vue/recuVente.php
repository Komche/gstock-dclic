<?php
include 'entete.php';

if (!empty($_GET['id'])) {
    $vente = getVente($_GET['id']);
}

?>
<div class="home-content">


    <button class="hidden-print" id="btnPrint" style="position: relative; left: 45%;"> <i class='bx bx-printer'></i> Imprimer</button>


    <div class="page">
        <div class="cote-a-cote">
            <h2>D-CLIC Stock</h2>
            <div>
                <p>Reçu N° #: <?= $vente['id'] ?> </p>
                <p>Date: <?= date('d/m/Y H:i:s', strtotime($vente['date_vente'])) ?> </p>
            </div>
        </div>

        <div class="cote-a-cote" style="width: 50%;">
            <p>Nom :</p>
            <p><?= $vente['nom'] . " " . $vente['prenom'] ?></p>
        </div>
        <div class="cote-a-cote" style="width: 50%;">
            <p>Tel :</p>
            <p><?= $vente['telephone'] ?></p>
        </div>
        <div class="cote-a-cote" style="width: 50%;">
            <p>Adresse :</p>
            <p><?= $vente['adresse'] ?></p>
        </div>
        
        <br>
        
        <table class="mtable">
            <tr>
                <th>Designation</th>
                <th>Quantité</th>
                <th>Prix unitaire</th>
                <th>Prix total</th>
            </tr>

            <tr>
                <td><?= $vente['nom_article'] ?></td>
                <td><?= $vente['quantite'] ?></td>
                <td><?= $vente['prix_unitaire'] ?></td>
                <td><?= $vente['prix'] ?></td>
            </tr>

        </table>
    </div>


</div>
</section>

<?php
include 'pied.php';
?>
<script>

    var btnPrint = document.querySelector('#btnPrint');
    btnPrint.addEventListener("click", () => {
        window.print();
    });

    function setPrix() {
        var article = document.querySelector('#id_article');
        var quantite = document.querySelector('#quantite');
        var prix = document.querySelector('#prix');

        var prixUnitaire = article.options[article.selectedIndex].getAttribute('data-prix');

        prix.value = Number(quantite.value) * Number(prixUnitaire);
    }
  
    
</script>