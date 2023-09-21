<?php 
// importation de constantes
require_once 'config/config.php';
// importation de la conexion a la BDD
require_once 'config/database.php';
//importation des helpers
require_once './helpers/category.helper.php';
require_once './helpers/post.helper.php';
// recuperation des categories


$categories = getCategories();

//$post = getPosts();
 
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Actunews</title>
</head>

<body>
    <!-- En tete de la page -->
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">Actunews - Premier sur l'info !</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav mx-auto text-center">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php">Accueil</a>
                        </li>
                        <?php foreach ($categories as $category) { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="categorie.php?slug=<?= $category['slug'] ?>">
                                <?= $category ['name']?>
                            </a>
                        </li>
                    <?php } ?>
                        
                    </ul>
                    <div class="text-right">
                        <a class="nav-item btn btn-outline-info mx-2" href="#">Connexion</a>
                        <a class="nav-item btn btn-outline-warning mx-2" href="#">Inscription</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <!-- Fin en tete de la page -->






 