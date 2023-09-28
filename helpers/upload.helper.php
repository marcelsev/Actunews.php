<?php

define('BASE_DIR', dirname(__DIR__));
const UPLOAD_DIR = BASE_DIR . DIRECTORY_SEPARATOR . 'uploads';

/**
 * Permet l'upload d'un fichier ou d'une image
 * TODO : Mettre en place une limite de poids
 * TODO : Si le fichier est une image, proposer une optimisation de poids et de taille.
 * param array $file
 * param string|null $name
 * param string $destination
 * param array $mimeTypes
 * return false|string
 */
function uploadFiles(array  $file,
                     string $name = null,
                     string $destination = '/',
                     array  $mimeTypes = ['image/jpeg', 'image/png', 'image/svg', 'image/png'])
{

    # 0. Vérifie si le format est autorisé
    if(!in_array($file['type'], $mimeTypes)) {
        return false;
    }

    #1. Récupérer mon fichier depuis son emplacement temporaire
    # dump($file);
    $tmpName = $file['tmp_name'];

    # 2. Récupération de l'extension du fichier
    $extension = pathinfo($file['name'])['extension'];
    $filename = pathinfo($file['name'])['filename'];
    # dump($extension);

    # 3. Je vais renommer mon image
    if ($name != null) {
        $slug = slugify($name);
        $fileName = $slug . '.' . $extension;
    } else {
        $slug = slugify($filename);
        $fileName = $slug . '.' . $extension;
    }
    # dump($fileName);
    
    # 4. Déterminer la destination du fichier (ou je vais stocker mon image)
    $folderDestination = UPLOAD_DIR . $destination . DIRECTORY_SEPARATOR;

    if(!file_exists($folderDestination)){
    mkdir($folderDestination);
}
    $fileDestination = $folderDestination . $fileName;

    # Il nous reste qu'à déplacer le fichier du dossier 'tmp' vers celui de destination
    move_uploaded_file($tmpName, $fileDestination);

    # On retourne le nom final de l'image pour le stockage dans la BDD
    return $fileName;

}