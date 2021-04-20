<?php

require 'config/DB.php';
require 'Library.php';

$library = new Library();

// Renvoie le nombre de livres, 6
echo $library->countBooks().'</br>';

 // Renvoie le nombre d'auteurs en BDD, 5
echo $library->countWriters().'</br>';

 // Récupère un tableau avec tous les romans
echo $library->getBooksByKind('Roman').'</br>';

// Récupère un tableau avec les livres écrits avant 1990
echo $library->getBooksWrittenBefore(1990).'</br>';

 // Récupère un tableau avec les livres écrits par J. K. Rowling
echo $library->getBooksWrittenBy('Rowling').'</br>';
