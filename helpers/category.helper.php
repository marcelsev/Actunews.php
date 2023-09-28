<?php

/**
 * Retourne les catégories
 * de notre site depuis la BDD
 * return string[]
 */
function getCategories(): array
{
    # Récupération de ma variable $dbh depuis l'espace global PHP
    global $dbh;

    # J'effectue ma requête de récupération des catégories
    $query = $dbh->query('SELECT * FROM category');

    # Je retourne le résultat
    return $query->fetchAll();
}

