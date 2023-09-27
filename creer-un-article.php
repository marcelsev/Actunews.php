<?php
# Inclusion du header
require_once './components/header.php';

$title = $slug = $content = $image = $id_category = $id_user  = null;
if (!empty($_POST)) { 
    
    $title = $_POST['title'];
    $slug = $_POST['slug'];
    $content = $_POST['content'];
    $image = $_FILES['image'];
    $id_category = $_POST['id_category'];
    $id_user = 1; #TODO: a remplacer plus tard l'utilisateur connecté

# verification des informations 
    $errors = [];


    # Vérification du title
    if (empty($title)){
        $errors['title'] = "N'oubliez pas le titre de votre article";
    }

    if (!empty($title) && strlen($title) > 255) {
        $errors['title'] = "Votre titre est trop long. Pas plus de 255 caractères.";
    }


    # Vérification de l'alias
    if (empty($slug)) {
        # On le génère nous même à partir du titre
        $slug = slugify($title);
    } else {
        # On le re-génère à partir de lui-même
        $slug = slugify($slug);
    }

    if (empty($content)) {
        $errors['content'] = "N'oubliez pas mettre le contenu.";
    }

    if (empty($image)) {
        $errors['image'] = "N'oubliez pas metre l'image.";
    }

    if ($category == "0") {
        $errors['id_category'] = "Choisissez une categorie.";
    }
    
  

    /* if (empty($errors)) {
        $idPost = insertUser($title, $slug, $content, $image, $category);
        if($idPost) {
             # TODO: Redirection vers la page connexion. Avec un message de confirmation.
             # TODO Idéalement, les messages sont passés via les sessions PHP. Message Flash.
             redirect('creer-un-article.php?info=Félicitation votre article a été bien creé.');
        }
} */
}




?>

<!-- Contenu de notre page -->
<!-- .p-3.mx-auto.text-center>h1.display-4{Actunews} -->
<main>

    <!-- Titre de la page -->
    <div class="p-3 mx-auto text-center">
        <h1 class="display-4">Créer un article</h1>
    </div>

    <!-- Contenu de la page -->
    <!-- .py-5.bg-light>.container>.row>.col-md-4*6>.card.shadow-sm -->
    <div class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-8 mx-auto">
                    <!--
                        enctype="multipart/form-data" : OBLIGATOIRE, il permet de transférer 
                        des données multimédia via votre formulaire. Ex. PDF, IMAGES, VIDEOS, ...
                    -->
                    <form id="createPostForm"  
                    enctype="multipart/form-data" 
                    method="post" 
                    action="creer-un-article.php">
                        <?php if (!empty($errors)) : ?>
                            <div class="alert alert-danger mt-4">
                                <u>Une erreur est survenue dans la validation de vos données :</u> <br>
                                <?php foreach ($errors as $error) : ?>
                                    <?= $error ?> <br>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                        <div class="mb-3">
                            <label for="title" class="form-label">Titre</label>
                            <input type="text" class="form-control <?= isset($errors['title']) ? 'is-invalid' : '' ?>" id="title" name="title" value="<?= $title ?>" placeholder="Saisissez votre titre">
                            <div class="invalid-feedback">
                                <?= $errors['title'] ?? '' ?>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="Slug" class="form-label">Alias</label>
                            <input type="text" class="form-control <?= isset($errors['slug']) ? 'is-invalid' : '' ?>" id="slug" name="slug" value="<?= $slug ?>" placeholder="Alias de l'article ">
                            <div class="invalid-feedback">
                                <?= $errors['slug'] ?? '' ?>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="id_category" class="form-label">Catégorie</label>
                            <select id="id_category" class="form-control <?= isset($errors['id_category']) ? 'is-invalid' : '' ?>" name="id_category">
                                <option  value="0">-- Choisissez une catégorie --</option>
                                <?php foreach ($categories as $category) : ?>
                                    <option 
                                    <?= $category['id']== $id_category ? 'selected' : '' ?>
                                    value="<?= $category['id_category'] ?>"><?= $category['name'] ?></option>
                                <?php endforeach ?>
                            </select>
                            <div class="invalid-feedback">
                                <?= $errors['id_category'] ?? '' ?>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="content" class="form-label ">Contenu</label>
                            <textarea name="content" class="form-control <?= isset($errors['content']) ? 'is-invalid' : '' ?>" id="content" placeholder="Saisissez votre contenu"><?= $content; ?></textarea>
                            <script>
                                CKEDITOR.replace('content');
                            </script>
                            <div class="invalid-feedback">
                                <?= $errors['content'] ?? '' ?>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" class="form-control <?= isset($errors['img']) ? 'is-invalid' : '' ?>" id="image" name="image" placeholder="Choisissez votre image">
                            <div class="invalid-feedback">
                                <?= $errors['image'] ?? '' ?>
                            </div>
                        </div>
                        <div class="d-grid gap-2">
                            <button class="btn btn-dark">Publier mon article</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</main>
<!-- Fin -- Contenu de notre page -->

<script src="./assets/js/creer-un-article.js"></script>
<?php
# Inclusion du header
require_once './components/footer.php';
?>