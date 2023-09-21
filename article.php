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

    
    <!-- Contenu de la page -->
    <!-- .py-5.bg-light>.container>.row>.col-md-4*6>.card.shadow-sm -->
    <div class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col">
                    <!-- Titre de la page -->
                    <h1 class="display-4"></h1>
                    <hr class="border border-dark mb-5">

                    <h4 class="text-muted d-flex justify-content-end align-items-center"><small></small></h4>
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
