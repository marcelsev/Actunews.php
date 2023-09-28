<?php


/**
 * Permet de vérifier le "role" d'un utilisateur
 * param string $role
 * return bool
 */
function isGranted(string $role){
    return isset($_SESSION['user']) && ($role === $_SESSION['user']['roles']);
}

/**
 * Permet de vérifier si un utilisateur
 * est connecté en session PHP.
 * @return array|false
 */
function isAuthenticated()
{
    return $_SESSION['user'] ?? false;
}

/**
 * Permet la connexion d'un utilisateur
 * @param string $email
 * @param string $password
 * @return bool
 */
function login(string $email, string $password)
{
    global $dbh;
    $sql = "SELECT * FROM user WHERE email = :email";
    $query = $dbh->prepare($sql);
    $query->bindValue('email', $email);
    $query->execute();

    # Récupération de l'user dans la BDD
    $user = $query->fetch();
    if ( $user &&  password_verify($password, $user['password'])) {
        /*
         * Ici, l'utilisateur à bien été trouvé et son mot de passe
         * correspond à celui dans la BDD... Je vais pouvoir stocker
         * ses informations en session PHP.
         */
        $_SESSION['user'] = $user;
        return true;
    }

    return false;
}

/**
 * Supprime l'utilisateur en session PHP.
 * return bool
 */
function logout(): bool {
    unset($_SESSION['user']);
    return true;
}