<?php
require_once './partials/header.php';

$user = isAuthenticated();
$userid = isset($user['id_user']) ? intval($user['id_user']) : 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $userid > 0) {
    $newFirstname = (isset($_POST['firstname']) && !empty($_POST['firstname'])) ? $_POST['firstname'] : null;
    $newLastname  = (isset($_POST['lastname']) && !empty($_POST['lastname'])) ? $_POST['lastname'] : null;
    $newUsername  = (isset($_POST['username']) && !empty($_POST['username'])) ? $_POST['username'] : null;

    if (updateProfil($userid, $newFirstname, $newLastname, $newUsername)) {
        echo "<div class='alert alert-success text-center'> Mise à jour réussie.</div>";
    } else {
        echo "Erreur lors de la mise à jour.";
    }
}


?>


<!-- .p-3.mx-auto.text-center>h1.display-4{Actunews} -->
<main>

    <!-- Titre de la page -->
    <div class="p-3 mx-auto text-center">
        <h1 class="display-4">Profil : <?=$user['firstname']?> </h1>
    </div>

    <p class="container text"><a href="#" id="lien-modifier-nom">Modifier</a></p>
<div style="display: none;" id="formModifier-nom" class="container">
    <h1>Modifier</h1>
    <form action="mon-profil.php" method="post">
        <input type="hidden" name="userID" value="<?=$user['id_user']?>"> 
        <label for="newFirstname" class="mb-3">Nouveau prenom :</label>
        <input type="text" name="firstname" id="newFirstname"><br>
        
        <label for="newLastname" class="mb-3">Nouveau nom :</label>
        <input type="text" name="lastname" id="newLastname"><br>
        
        <label for="newUsername" class="mb-3">Nouveau pseudo :</label>
        <input type="text" name="username" id="newUsername"><br>
        
        <input class="btn btn-dark" type="submit" value="valider">
    </form>
    </div>
    <!-- .py-5.bg-light>.container>.row>.col-md-4*6>.card.shadow-sm -->
    <div class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h3>Nom :</h3>
                    <h2><?=$user['lastname']?></h2>
                   
                </div>
            </div>
        </div>
    </div>
    <div class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h3>Prenom :</h3>
                    <h2><?=$user['firstname']?></h2>
                    
                </div>
            </div>
        </div>
    </div>
    <div class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h3>Pseudo :</h3>
                    <h2><?=$user['username']?></h2>
                    
                </div>
            </div>
        </div>
    </div> 
</main>
<!-- Fin -- Contenu de notre page -->


<!-- function js-->
<script>
    document.querySelector('#lien-modifier-nom').addEventListener('click', function(){
        document.querySelector('#lien-modifier-nom').style.display = 'none';
        document.querySelector('#formModifier-nom').style.display ='block';
    })
    document.querySelector('#lien-modifier-prenom').addEventListener('click', function(){
        document.querySelector('#lien-modifier-prenom').style.display = 'none';
        document.querySelector('#formModifier-prenom').style.display ='block';
    })
    document.querySelector('#lien-modifier-pseudo').addEventListener('click', function(){
        document.querySelector('#lien-modifier-pseudo').style.display = 'none';
        document.querySelector('#formModifier-pseudo').style.display ='block';
    })
</script>

<?php
# Inclusion du header
require_once './partials/footer.php';
?>