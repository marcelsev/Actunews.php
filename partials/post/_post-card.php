<div class="col-md-4 mt-4">
    <div class="card shadow-sm h-100">
        <img class="img-fluid" src="uploads/posts/<?= $post['image']?>" alt="<?= $post['title'] ?>">
        <div class="card-body">
            <h5 class="card-title"><?= $post['title'] ?></h5>
            <small class="text-muted">
                <a href="auteur.php?ID=<?= $post['id_user'] ?>"><?= $post['firstname'] . ' ' . $post['lastname']
                . '</a> | Publié le ' . $post['created_at']  ?>
            </small>
            <p class="card-text">
                <?= summarize($post['content'], 120) ?>
            </p>
            <a href="article.php?slug=<?= $post['postSlug'] ?>" class="btn btn-primary">
                Lire la suite
            </a>
        </div>
    </div>
</div>