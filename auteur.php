<?php
# Inclusion du header
require_once './components/header.php';

# Récupération de mes articles
$userId = $_GET['ID'];
$posts = getPostsByUserId($userId);
//dump($posts);

# Récupération de l'auteur
$user = getUserById($userId);
//dump($user);

?>

<!-- Contenu de notre page -->
<!-- .p-3.mx-auto.text-center>h1.display-4{Actunews} -->
<main>

    <!-- Titre de la page -->
    <div class="p-3 mx-auto text-center">
        <h1 class="display-4"><?=$user['firstname'] ?> <?=$user['lastname'] ?></h1>
    </div>

    <!-- Contenu de la page -->
    <!-- .py-5.bg-light>.container>.row>.col-md-4*6>.card.shadow-sm -->
    <div class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <?php foreach ($posts as $post):
                    include 'components/post/_post-card.php';
                endforeach ?>
            </div>
        </div>
    </div>

</main>
<!-- Fin -- Contenu de notre page -->

<?php
# Inclusion du footer
require_once './components/footer.php';
?>
