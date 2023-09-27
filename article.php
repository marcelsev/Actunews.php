<?php

# Inclusion du header

require_once './components/header.php';

$slug = $_GET['slug'];
$post = getPostBySlug($slug);
//var_dump($post);
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
                    <!-- Titre de l'article -->
                    <h1 class="display-4"><?=$post['title']?></h1>

                    <hr class="border border-dark" >

                    <h4 class="text-muted d-flex justify-content-between align-items-center">

                        <p class="m-0"><small style="font-size: 1rem; margin-right: 1rem;">Publié le</small> <?=$post['created_at']?></p>

                        <p class="m-0"><small style="font-size: 1rem; margin-right: 1rem;">Rédigé par </small> Hugo LIEGEARD</p>

                    </h4>

                    <hr class="border border-dark mb-5" >
                    <!-- Illustration de l'article -->

                    <img class="img-fluid mb-5" src="<?=$post['image']?>"

                         alt="[TITRE]">
                    <!-- Contenu de l'article' -->
                    <p><?=$post['content']?></p>
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