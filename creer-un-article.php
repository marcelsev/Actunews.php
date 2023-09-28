<?php
# Inclusion du header
require_once './partials/header.php';

# Vérification des droits d'accès
$user = isAuthenticated();
if ( !$user || ($user && !isGranted('ROLE_REPORTER')) ) {
    addFlash('danger', "Vous n'avez pas les droits suffisants pour cette opération.");
    redirect("connexion.php");
}

# 1. Récupération des informations
# Initialisation des variables à null
$title = $slug = $content = $id_category = $image = $id_user = null;

# 2. Vérification des données $_POST
if (!empty($_POST)) {

    # 3. Récupération des informations $_POST
    $title = $_POST['title'];
    $slug = $_POST['slug'];
    $content = $_POST['content'];
    $id_category = $_POST['id_category'] ?? 0;
    $id_user = 1; # TODO : A remplacer plus tard par l'utilisateur connecté
    $image = $_FILES['image'];

    # 4. Vérification des informations
    $errors = [];

    # Vérification du titre
    if (empty($title)) {
        $errors['title'] = "N'oubliez pas le titre de votre article";
    }

    if (!empty($title) && strlen($title) > 255) {
        $errors['title'] = "Votre titre est trop long. Pas plus de 255 caractères.";
    }

    # Vérification de l'alias
    if (empty($slug)) {
        if (!empty($title)) {
            # On le génère nous même à partir du titre
            $slug = slugify($title);
        } else {
            $errors['slug'] = "Vous devez saisir un titre pour générer un alias.";
        }
    } else {
        # On le re-génère à partir de lui-même
        $slug = slugify($slug);
    }

    # Vérification du contenu
    if (empty($content)) {
        $errors['content'] = "N'oubliez pas le contenu de votre article.";
    }

    # Vérification de la catégorie
    if (empty($id_category)) {
        $errors['id_category'] = "N'oubliez pas la catégorie de votre article";
    }

    #5. TODO Upload de l'image
    if (empty($image['size'])) {
        $errors['image'] = "N'oubliez pas l'image de votre article";
    }

    $image = uploadFiles($image, $title, '/posts');

    #6. TODO Notification Flash
    #7. Insertion dans la BDD
    if (empty($errors)) {
        try {
            $id_post = insertPost($title, $slug, $content, $id_category, $id_user, $image);
            if ($id_post) {
                addFlash('success', 'Félicitation, votre article est en ligne !');

                redirect("article.php?slug=$slug");
            }
        } catch (Exception $exception) {
            dd($exception->getMessage());
        }
    }


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
                          method="post">

                        <!-- Affichage d'une notification d'erreur -->
                        <?php if (!empty($errors)): ?>
                            <div class="alert alert-danger mt-4">
                                <u>Une erreur est survenue dans la validation de vos données :</u> <br>
                                <?php foreach ($errors as $error) : ?>
                                    <?= $error ?> <br>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>

                        <div class="mb-3">
                            <label for="title" class="form-label">Titre</label>
                            <input type="text" class="form-control <?= isset($errors['title']) ? 'is-invalid' : '' ?>"
                                   id="title" name="title" value="<?= $title ?>" placeholder="Saisissez votre titre">
                            <div class="invalid-feedback">
                                <?= $errors['title'] ?? '' ?>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="Slug" class="form-label">Alias</label>
                            <input type="text" class="form-control <?= isset($errors['slug']) ? 'is-invalid' : '' ?>"
                                   id="slug" name="slug" value="<?= $slug ?>" placeholder="Alias de l'article   ">
                            <div class="invalid-feedback">
                                <?= $errors['slug'] ?? '' ?>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="id_category" class="form-label">Catégorie</label>
                            <select
                                    id="id_category" name="id_category"
                                    class="form-control <?= isset($errors['id_category']) ? 'is-invalid' : '' ?>"
                                    name="id_category">

                                <option selected disabled value="0">-- Choisissez une catégorie --</option>
                                <?php foreach ($categories as $category): ?>
                                    <option
                                        <?= $category['id_category'] == $id_category ? 'selected' : '' ?>
                                            value="<?= $category['id_category'] ?>">
                                        <?= $category['name'] ?>
                                    </option>
                                <?php endforeach ?>
                            </select>
                            <div class="invalid-feedback">
                                <?= $errors['id_category'] ?? '' ?>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="content" class="form-label">Contenu</label>
                            <textarea class="form-control <?= isset($errors['content']) ? 'is-invalid' : '' ?>"
                                      id="content" name="content"
                                      placeholder="Saisissez votre contenu"><?= $content ?></textarea>
                            <script>
                                CKEDITOR.replace('content');
                            </script>
                            <div class="invalid-feedback">
                                <?= $errors['content'] ?? '' ?>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" class="form-control <?= isset($errors['image']) ? 'is-invalid' : '' ?>"
                                   id="image" name="image" placeholder="Choisissez votre image">
                            <?php if (isset($errors['image'])) : ?>
                                <div id="imageHelp" class="form-text text-danger">
                                    <?= $errors['image'] ?? '' ?>
                                </div>
                            <?php endif; ?>
                            <div id="imageHelp" class="form-text">
                                Seul les formats .jpg, .jpeg, .gif et .png sont autorisés jusqu'à une taille de maximal
                                de 5Mo
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

<!-- Chargement de mon script -->
<script src="assets/js/creer-un-article.js"></script>

<?php
# Inclusion du header
require_once './partials/footer.php';
?>
