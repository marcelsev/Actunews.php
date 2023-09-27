





    <!-- Pied de page -->

    <footer class="mt-4 pt-4 ">
        <div class="container border-top">
            <div class="row">
                <div class="col-12 col-md">
                    <h5>Actunews</h5>
                    <small class="d-block text-muted">&copy; <?= date('Y')?></small>
                </div>
                <div class="col-6 col-md">
                    <h5>Catégories</h5>
                    <ul class="list-unstyled">
                    <?php foreach ($categories as $category) { ?>
                        <li>
                            <a href="categorie.php?slug=<?= $category['slug'] ?>" class="text-muted"><?= $category ['name']?></a>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
                <div class="col-6 col-md">
                    <ul class="list-unstyled">
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
                    <p class="text-center text-white">&copy; Actunews  <?= date('Y')?></p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Fin Pied de page -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>