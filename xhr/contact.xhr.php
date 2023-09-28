<?php

# Permet d'indiquer que ce fichier contiendra et retournera du JSON
header('Content-Type: application/json');

# Chargement des fichiers
require_once '../config/config.php';
require_once '../config/database.php';
require_once '../helpers/global.helper.php';

# Création des variables à partir des données POST
foreach ($_POST as $key => $value) {
    $$key = $value;
}

# TODO : Vérification en PHP des variables...
# Insertion du commentaire dans la BDD

$sql = 'INSERT INTO contact (fullname, email, subject, message, created_at) 
                VALUES (:fullname, :email, :subject, :message, :created_at)';

$query = $dbh->prepare($sql);
$query->bindValue('fullname', $fullname);
$query->bindValue('email', $email);
$query->bindValue('subject', $subject);
$query->bindValue('message', $message);
$query->bindValue('created_at', (new DateTime())->format('Y-m-d H:i:s') );

if($query->execute()) {
    echo json_encode([
        'code' => 201,
        'status' => true,
        'fullname' => $fullname 
       ]);
} else {
    echo json_encode([
        'code' => 500,
        'status' => false
    ]);
}