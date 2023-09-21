<?php
/* 
*retourne les categories
*de notre site
*@return string[]
*/

function getCategories() : array
{
    //recuperation de ma varbale $dbh  depuis l'espace global php
    global $dbh;
    # j'effectue  ma requete de recuperation des categories
    $query = $dbh -> query('SELECT * FROM category');
    #je retourne le resultat
    return $query-> fetchAll();
}



?>