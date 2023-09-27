<?php
require_once './components/header.php'; // la page ne s'affiche pas s'il y a un erreur
//include_once './components/header.php';// c'est affiche le reste de la page s'il y a un erreur

// recuperation de mes articles 
$posts = getPosts(6);
//var_dump($posts);
?>

<!-- Contenu de notre page -->
<main>

    <!-- Titre de la page -->
    <div class="p-3 mx-auto text-center">
        <h1 class="display-4">Actunews</h1>
    </div>

    <!-- Contenu de la page -->
    <!-- .py-5.bg-light>.container>.row>.col-md-4*6>.card.shadow-sm -->
    <div class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <?php foreach ($posts as $post):
                    include './components/post/_post-card.php';
                endforeach ?>
            </div>
        </div>
    </div>

</main>
<!-- Fin -- Contenu de notre page -->

<!-- fin de contenu de notre page -->

<?php
require_once './components/footer.php'; // la page ne s'affiche pas s'il y a un erreur
//include_once './components/header.php';// c'est affiche le reste de la page s'il y a un erreur
?>