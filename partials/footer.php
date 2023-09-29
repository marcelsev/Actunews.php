<!-- Pied de page -->




<footer class="mt-4 pt-4 ">
    <div class="container border-top">
        <div class="row">
            <div class="col-12 col-md">
                <h5>Actunews</h5>
                <small class="d-block text-muted">&copy; <?php echo date("Y"); ?> </small>
            </div>
            <div class="col-6 col-md">
                <h5>Catégories</h5>
                <ul class="list-unstyled">
               <?php foreach ($categories as $category) { ?>
                    <li>
                        <a href="categorie.php?slug=<?= $category['slug']?>" 
                        class="text-muted"><?=$category['name']?></a>
                    </li>
                <?php } ?>
                </ul>
            </div>
            <div class="col-6 col-md">
                <ul class="list-unstyled">
                    <li><a href="contact.php" class="text-muted">Contactez-nous</a></li>
                    <li><a href="#" class="text-muted">Mentions légales</a></li>
                    <li><a href="#" class="text-muted">Politique de confidentialité</a></li>
                    <li><a href="#" class="text-muted">Plan du site</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-dark">
        <div class="row">
            <div class="col">
                <p class="text-center text-white">&copy; Actunews  <?php echo date("Y"); ?> </p>
            </div>
        </div>
    </div>
</footer>
<!-- Fin -- Pied de page -->

</body>
</html>