<?php

/**
 * Dans ce fichier, je vais définir des variables utiles pour
 * le site. Toutes les variables définies dans ce fichier
 * seront accessibles sur toutes les pages.
 */

// Renvoie la page actuelle sur laquelle on se situe
// Pour récupérer la page actuelle, on peut utiliser $_SERVER

// explode transforme la chaine en tableau et array_pop prend la
// dernière valeur du tableau
$scripts = explode('/', $_SERVER['SCRIPT_NAME']);
$page = array_pop($scripts); // index.php ou acteurs.php

if (!isset($title)) {
    $title = 'Library';
}
if (!isset($style)) {
    $style = '';
}
