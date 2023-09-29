<?php
    # Récupération de l'utilisateur connecté
    # dd($_SESSION);
    $user = isAuthenticated();
?>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">ActuNews - Premier sur l'info !</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto text-center">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Accueil</a>
                </li>
                <?php foreach ($categories as $category) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="categorie.php?slug=<?= $category['slug'] ?>">
                            <?= $category['name'] ?>
                        </a>
                    </li>
                <?php } ?>
            </ul>

            <div class="text-right">
                <?php if ($user) : ?>

                    <span class="navbar-text mx-2 " ><a href="mon-profil.php">
                        Bonjour </a><strong><?= $user['firstname'] ?></strong>
                         <em>(<?= $user['roles'] ?>)</em>
                    </span>

                    <?php if (isGranted('ROLE_REPORTER')) : ?>
                        <a class="nav-item btn btn-outline-warning" href="creer-un-article.php">
                            Créer un article
                        </a>
                    <?php endif; ?>
                    <a class="nav-item btn btn-danger" href="deconnexion.php">Deconnexion</a>

                <?php else: ?>
                    <a class="nav-item btn btn-outline-info" href="connexion.php">Connexion</a>
                    <a class="nav-item btn btn-outline-warning mx-2" href="inscription.php">Inscription</a>
                <?php endif; ?>
            </div> <!-- ./text-right -->

        </div> <!-- ./collapse -->
    </div> <!-- ./container-fluid -->
</nav> <!-- /nav -->
