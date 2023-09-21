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
