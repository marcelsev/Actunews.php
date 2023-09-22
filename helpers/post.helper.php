<?php
function getPosts(int $limit = null)
{

    #todo recuperer et retourner tous les articles de la BDD
    global $dbh;
    //creation de ma requete SQL
    $sql = 'SELECT p.id_post, p.title, p.content, p.image, p.slug as postSlug, p.created_at, c.name, c.slug as categorySlug, u.firstname, u.lastname, u.username FROM post p INNER JOIN category c on p.id_category = c.id_category INNER JOIN user u on p.id_user = u.id_user ORDER BY p.created_at DESC';

    //si une $liit a ete passe en parametre de la fonction alors je l'ajoute a la requete
    $limit !== null ? $sql .= " LIMIT $limit" : '';
    $query = $dbh->query($sql);
    #TODO bonus : on souhaite recuperer egalemetn, l'auteur (pseudo) et la categorie (name)
    //$query = $dbh -> query('SELECT username as auteur, category_ame as category FROM post INNER JOIN user ON post.id_user = user.id_user INNER JOIN category ON post.id_category = category.id_category WHERE post.id_post= "category, auteur"');
    #TODO bonus: ajouter en parametre une limit d'article a recuperer  
    return $query->fetchAll();
}


/**
 * Permet de récupérer les articles
 * de la BDD via le slug de la catégorie.
 */
function getPostsByCategorySlug(string $categorySlug) {

    global $dbh;

    # Création de ma requête SQL
    $sql = 'SELECT p.id_post,
               p.title,
               p.content,
               p.image,
               p.slug as postSlug,
               p.created_at,
               c.name,
               c.slug as categorySlug,
               u.firstname,
               u.lastname,
               u.username
            FROM post p
                INNER JOIN category c on p.id_category = c.id_category
                INNER JOIN user u on p.id_user = u.id_user
                    WHERE c.slug = :categorySlug
                        ORDER BY p.created_at DESC';

    # Préparation de ma requête
    # ⚠️⚠️ Paramètre externe = requête préparée ⚠️⚠️
    $query = $dbh->prepare($sql);

    # J'associe à ma requête le paramètre categorySlug.
    # NOTA BENE : Cette préparation me protège contre les injections SQL.
    $query->bindValue(':categorySlug', $categorySlug, PDO::PARAM_STR);

    # Execution de ma requête
    $query->execute();

    # Retour du résultat
    return $query->fetchAll();
}