<?php
require_once './components/header.php'; // la page ne s'affiche pas s'il y a un erreur
//include_once './components/header.php';// c'est affiche le reste de la page s'il y a un erreur

// recuperation de mes articles 
$posts = getPosts(6);
//var_dump($posts);
?>

<!-- Contenu de notre page -->
<main>
    <!-- .p-3.mx-auto.text-center>h1.display-4{Actunews} -->
    <!-- titre de la page -->
    <div class="p-3 mx-auto text-center">
        <h1 class="display-4">Actunews</h1>
    </div>
    <!-- contenu de la page -->
    <div class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <?php foreach ($posts as $post): ?>
                <div class="col-md-4 mt-4">
                    <div class="card shadow-sm h-100"><img class="img-fluid" src="<?= $post['image']?>" alt="<?= $post['title']?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= $post['title'] ?></h5>
                            <small class="text-muted">
                                    <?= $post['firstname'] . ' ' . $post['lastname']
                                    . ' | Publié le ' . $post['created_at']  ?>
                                </small>
                            <p class="card-text">
                            <?= summarize($post['content'], 120) ?>
                            </p>
                            <a href="#" class="btn btn-primary">Lire la suite</a>
                        </div>
                    </div>
                </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>

</main>
<!-- fin de contenu de notre page -->

<?php
require_once './components/footer.php'; // la page ne s'affiche pas s'il y a un erreur
//include_once './components/header.php';// c'est affiche le reste de la page s'il y a un erreur
?>