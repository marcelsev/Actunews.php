<?php

/**
 * Retourne les informations de l'utilisateur
 * via son ID.
 * return void
 */
function getUserById(int $idUser)
{
    global $dbh;
    $sql = 'SELECT * FROM user WHERE user.id_user = :idUser';
    # Préparation de ma requête
    # ⚠️⚠️ Paramètre externe = requête préparée ⚠️⚠️
    $query = $dbh->prepare($sql);

    # J'associe à ma requête le paramètre categorySlug.
    # NOTA BENE : Cette préparation me protège contre les injections SQL.
    $query->bindValue(':idUser', $idUser, PDO::PARAM_INT);

    # Execution de ma requête
    $query->execute();
    # Retour du résultat
    return $query->fetch();
}

/**
 * Permet l'insertion d'un utilisateur
 * dans la base de données
 * param string $firstname
 * param string $lastname
 * param string $username
 * param string $email
 *param string $password
 * param string $roles
 * return false|string
 */
function insertUser(
    string $firstname,
    string $lastname,
    string $username,
    string $email,
    string $password,
    string $roles = 'ROLE_USER'
) {
    global $dbh;
    $sql = 'INSERT INTO user (firstname, lastname, username, email, password, roles, created_at, updated_at) 
                VALUES (:firstname, :lastname, :username, :email, :password, :roles, :created_at, :updated_at)';

    $query = $dbh->prepare($sql);
    $query->bindValue('firstname', $firstname);
    $query->bindValue('lastname', $lastname);
    $query->bindValue('username', $username);
    $query->bindValue('email', $email);
    $query->bindValue('password', password_hash($password, PASSWORD_DEFAULT));
    $query->bindValue('roles', $roles);
    $query->bindValue('created_at', (new DateTime())->format('Y-m-d H:i:s'));
    $query->bindValue('updated_at', (new DateTime())->format('Y-m-d H:i:s'));

    return $query->execute() ? $dbh->lastInsertId() : false;
}


//$user = $_SESSION['user'];
//dd($user);
function updateProfil(
    int $userId,
    string $newFirstname = null,
    string $newLastname = null,
    string $newUsername = null
) {

    global $dbh;
    $sql = 'UPDATE user SET ';

    $setArray = array();

    if ($newFirstname !== null) {
        $setArray[] = 'firstname = :firstname';
    }

    if ($newLastname !== null) {
        $setArray[] = 'lastname = :lastname';
    }

    if ($newUsername !== null) {
        $setArray[] = 'username = :username';
    }

    if (!empty($setArray)) {
        $sql .= $setArray[0];
        for ($i = 1; $i < count($setArray); $i++) {
            $sql .= ', ' . $setArray[$i];
        }
    }

    $sql .= ' WHERE id_user = :id_user';

    
    $query = $dbh->prepare($sql);
    $query->bindValue(':id_user', $userId, PDO::PARAM_INT);

    if ($newFirstname !== null) {
        $query->bindValue(':firstname', $newFirstname, PDO::PARAM_STR);
    }
    if ($newLastname !== null) {
        $query->bindValue(':lastname', $newLastname, PDO::PARAM_STR);
    }
    if ($newUsername !== null) {
        $query->bindValue(':username', $newUsername, PDO::PARAM_STR);
    }


    return $query->execute();
}
