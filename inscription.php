<?php
# Inclusion du header
require_once './partials/header.php';

#1. Récupération des informations
# Initialisation des variables à null
$firstname = $lastname = $username = $email = $password = null;

# $_POST ne peut pas être vide quand l'utilisateur a soumis les données de son formulaire.
if (!empty($_POST)) {

    #2. Je peux commencer ma validation
    $firstname = $_POST['firstname']; # Contient les données du champ #firstname
    $lastname = $_POST['lastname']; # Contient les données du champ #lastname
    $username = $_POST['username']; # Contient les données du champ #username
    $email = $_POST['email']; # Contient les données du champ #email
    $password = $_POST['password']; # Contient les données du champ #password

    #3. Vérification des informations saisies
    # Déclarer un tableau d'erreurs
    $errors = [];

    # Vérification du firstname
    if (empty($firstname)) {
        $errors['firstname'] = "N'oubliez pas votre prénom.";
    }

    if (empty($lastname)) {
        $errors['lastname'] = "N'oubliez pas votre nom.";
    }

    if (empty($username)) {
        $errors['username'] = "N'oubliez pas votre pseudo.";
    }

    if (empty($email)) {
        $errors['email'] = "N'oubliez pas votre email.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Vérifier le format de votre e-mail.";
    }

    if (empty($password)) {
        $errors['password'] = "N'oubliez pas votre mot de passe.";
    }

    if (!empty($password) && strlen($password) < 12) {
        $errors['password'] = "Votre mot de passe est trop court. Pas moins de 12 caractères.";
    }

    #4. S'il n'y a aucune erreur dans mon tableau, alors je peux procéder à l'insertion dans la BDD
    if (empty($errors)) {
        try {
        dump('entre dans empty post');
        $idUser = insertUser(...$_POST);
        if ($idUser) {
            //dump('idUser');
            // alerte de confirmation
            addFlash('success', 'Félicitation votre inscription est effective. Vous pouvez vous connecter.');
            # Redirection vers la page connexion. Avec un message de confirmation.
            # TODO Idéalement, les messages sont passés via les sessions PHP. Message Flash.
            redirect("connexion.php");
        }
    } catch(Exception $e) {
        $e->getMessage();
    }
    }

} // endif(empty($POST))



?>

<!-- Contenu de notre page -->
<!-- .p-3.mx-auto.text-center>h1.display-4{Actunews} -->
<main>

    <!-- Titre de la page -->
    <div class="p-3 mx-auto text-center">
        <h1 class="display-4">Inscription</h1>
    </div>

    <!-- Contenu de la page -->
    <!-- .py-5.bg-light>.container>.row>.col-md-4*6>.card.shadow-sm -->
    <div class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-8 mx-auto">
                    <form id="register" method="post" action="inscription.php">

                        <!-- Affichage d'une notification d'erreur -->
                        <?php if (!empty($errors)): ?>
                            <div class="alert alert-danger mt-4">
                                <u>Une erreur est survenue dans la validation de vos données :</u> <br>
                                <?php foreach ($errors as $error) : ?>
                                    <?= $error ?> <br>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>

                        <!-- Prénom -->
                        <div class="mb-3">
                            <label for="firstname" class="form-label">Prénom</label>
                            <input type="text"
                                   class="form-control <?= isset($errors['firstname']) ? 'is-invalid' : '' ?>"
                                   id="firstname" name="firstname"
                                   value="<?= $firstname ?>"
                                   placeholder="Saisissez votre prénom">
                            <div class="invalid-feedback">
                                <?= $errors['firstname'] ?? '' ?>
                            </div>
                        </div>

                        <!-- Nom -->
                        <div class="mb-3">
                            <label for="lastname" class="form-label">Nom</label>
                            <input type="text"
                                   class="form-control <?= isset($errors['lastname']) ? 'is-invalid' : '' ?>"
                                   id="lastname" name="lastname"
                                   value="<?= $lastname ?>"
                                   placeholder="Saisissez votre nom">
                            <div class="invalid-feedback">
                                <?= $errors['lastname'] ?? '' ?>
                            </div>
                        </div>

                        <!-- Pseudo -->
                        <div class="mb-3">
                            <label for="username" class="form-label">Pseudo</label>
                            <input type="text"
                                   class="form-control <?= isset($errors['username']) ? 'is-invalid' : '' ?>"
                                   id="username" name="username"
                                   value="<?= $username ?>"
                                   placeholder="Saisissez votre pseudo">
                            <div class="invalid-feedback">
                                <?= $errors['username'] ?? '' ?>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>"
                                   id="email" name="email"
                                   value="<?= $email ?>"
                                   placeholder="Saisissez votre email">
                            <div class="invalid-feedback">
                                <?= $errors['email'] ?? '' ?>
                            </div>
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Mot de passe</label>
                            <input type="password"
                                   class="form-control <?= isset($errors['password']) ? 'is-invalid' : '' ?>"
                                   id="password" name="password"
                                   value="<?= $password ?>"
                                   placeholder="Saisissez votre mot de passe">
                            <div class="invalid-feedback">
                                <?= $errors['password'] ?? '' ?>
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button class="btn btn-dark">M'inscrire</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

</main>
<!-- Fin -- Contenu de notre page -->

<?php
# Inclusion du header
require_once './partials/footer.php';
?>
