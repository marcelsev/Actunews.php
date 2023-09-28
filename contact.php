<?php
# Inclusion du header
require_once './partials/header.php';

?>

    <!-- Contenu de notre page -->
    <!-- .p-3.mx-auto.text-center>h1.display-4{Actunews} -->
    <main>

        <!-- Titre de la page -->
        <div class="p-3 mx-auto text-center">
            <h1 class="display-4">Nous contacter</h1>
        </div>

        <!-- Contenu de la page -->
        <!-- .py-5.bg-light>.container>.row>.col-md-4*6>.card.shadow-sm -->
        <div class="py-5 bg-light">
            <div class="container">
                <div class="row">
                    <div class="col-8 mx-auto">
                        <form novalidate id="contact" method="post" action=traitement.php">

                            <!-- Affichage d'une notification d'erreur -->
                            <?php if (!empty($errors)) : ?>
                                <div class="alert alert-danger mt-4">
                                    <u>Une erreur est survenue dans la validation de vos données :</u> <br>
                                    <?php foreach ($errors as $error) : ?>
                                        <?= $error ?> <br>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>

                            <!-- Nom & Prénom -->
                            <div class="mb-3">
                                <label for="fullname" class="form-label">Nom & Prénom</label>
                                <input required type="text" class="form-control " id="fullname" name="fullname" value=""
                                       placeholder="Saisissez votre nom complet">
                            </div>

                            <!-- Email -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input required type="email" class="form-control" id="email" name="email" value=""
                                       placeholder="Saisissez votre email">
                            </div>

                            <!-- Sujet -->
                            <div class="mb-3">
                                <label for="subject" class="form-label">Sujet</label>
                                <input required type="text" class="form-control " id="subject" name="subject" value=""
                                       placeholder="Saisissez votre sujet">
                            </div>

                            <!-- Message -->
                            <div class="form-floating">
                                <textarea required name="message" class="form-control"
                                          placeholder="Laissez-nous votre message"
                                          id="floatingTextarea2" style="height: 100px"></textarea>
                                <label for="floatingTextarea2">Votre message</label>
                            </div>

                            <br>
                            <div class="d-grid gap-2">
                                <button id="contactBtn" class="btn btn-dark">
                                    <span class="spinner-border spinner-border-sm d-none" aria-hidden="true"></span>
                                    <span role="status">Envoyer ma demande de contact</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </main>
    <!-- Fin -- Contenu de notre page -->

    <!-- Chargement de Jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
            integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
            <script>
        $(function () {
            console.log('page loaded, jquery is ready !');

        });

        $('#contact').submit(function (event) {
            // Bloquer l'action par défaut du formulaire
            event.preventDefault();

            /*
                Cette classe va me permet d'activer la validation bootstrap.
             */
            $(this).addClass('was-validated');

            // Si mon formulaire est valide, je peux transmettre mes données en Asynchrone.
            if ($(this)[0].checkValidity()) {

                // Je vais créer une nouvelle requete asynchrone
                $.ajax({
                    type        : $(this).attr('method'),
                    url         : $(this).attr('action'),
                    data        : $(this).serialize(),
                    dataType    : 'JSON',
                    timeout     : 5000,
                    beforeSend  : () => {
                        // Avant l'envoi de la requete en Async
                        // Désactivation du bouton
                        $('#contactBtn').attr('disabled', 'disabled');
                        $('#contactBtn .spinner-border').removeClass('d-none');
                    },
                    complete    : () => {
                        // S'exécute une fois que la requete a obtenu du serveur une réponse
                        $('#contactBtn').removeAttr('disabled');
                        $('#contactBtn .spinner-border').addClass('d-none');
                    }
                }).done(result => {
                    // "result" contient le retour de la réponse du script PHP
                });

            }
        });
    </script>

<?php
# Inclusion du header
require_once './partials/footer.php';
?>