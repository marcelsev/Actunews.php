<?php
# Inclusion du header
require_once './partials/header.php';

# Récupération du paramètre slug depuis l'URL
$slug = $_GET['slug'];

// en cas d'absense du slug 
if (!isset($_GET['slug'])){
    redirect('accueil.html');
}
# Récupération de l'article
$post = getPostBySlug($slug);

if(!$post){
    redirect('erreur404.php');
}
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
                    <h1 class="display-4"><?= $post['title'] ?></h1>

                    <hr class="border border-dark" >

                    <!-- Information de l'article -->
                    <h4 class="text-muted d-flex justify-content-between align-items-center">
                        <p class="m-0"><small style="font-size: 1rem; margin-right: 1rem;">Publié le</small> <?= $post['created_at'] ?></p>
                        <p class="m-0"><small style="font-size: 1rem; margin-right: 1rem;">Catégorie </small> <?= $post['name'] ?></p>
                        <p class="m-0"><small style="font-size: 1rem; margin-right: 1rem;">Rédigé par </small> <?= $post['firstname'] . ' ' . $post['lastname'] ?></p>
                    </h4>

                    <hr class="border border-dark mb-5" >

                    <!-- Illustration de l'article -->
                    <img class="img-fluid mb-5" src="uploads/posts/<?= $post['image']?>"
                         alt="<?= $post['title'] ?>">

                    <!-- Contenu de l'article' -->
                    <p><?= $post['content']?></p>

                </div> <!-- ./col -->
            </div> <!-- ./row -->
        </div> <!-- ./container -->
    </div> <!-- ./bg-light -->

</main>
<!-- Fin -- Contenu de notre page -->

<?php
# Inclusion du header
require_once './partials/footer.php';
?>
