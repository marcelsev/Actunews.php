<?php
    # Inclusion du header
    require_once './components/header.php';
     /*
     * La superglobale GET me permet de récupérer les informations
     * passées dans mon URL. Ex. categorie.php?slug=politique
     */
    //var_dump($_GET);
?>

<!-- Contenu de notre page -->
<!-- .p-3.mx-auto.text-center>h1.display-4{Actunews} -->
<main>

    <!-- Titre de la page -->
    <div class="p-3 mx-auto text-center">
        <h1 class="display-4 text-capitalize"> <?= $_GET['slug'] ?></h1>
    </div>

    <!-- Contenu de la page -->
    <!-- .py-5.bg-light>.container>.row>.col-md-4*6>.card.shadow-sm -->
    <div class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h3>Page d'Exemple</h3>
                </div>
            </div>
        </div>
    </div>

</main>
<!-- Fin -- Contenu de notre page -->

<?php
# Inclusion du header
require_once './components/footer.php';
?>
