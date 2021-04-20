<?php
require 'config/DB.php';


function formatDate($date, $format = '%d %B %Y')
{
    setlocale(LC_ALL, 'fr.utf-8');

    return strftime($format, strtotime($date));
}

$title = $_POST['title'] ?? null;
$kind = $_POST['kind'] ?? null;
$published_at = $_POST['published_at'] ?? null;

$errors = [];

var_dump($_POST);

if (!empty($_POST)) {

    if (strlen($title) < 1) {
        $errors['title'] = 'Le titre n\'est pas assez long.';
    }
    if (strlen($kind) < 1) {

        $errors['kind'] = 'Le genre n\'est pas assez long.';
    }

    $month = formatDate($published_at, '%m');
    $day = formatDate($published_at, '%d');
    $year = formatDate($published_at, '%Y');

    if ($published_at !== formatDate($published_at, '%Y-%m-%d') || !checkdate($month, $day, $year)) {

        $errors['published_at'] = 'La date n\'est pas valide';
    }

    if (empty($errors)) {
        $query = DB::postQuery('INSERT INTO book (title, kind, published_at) VALUES (:title, :kind, :published_at)', $_POST);
        header('Location: book_add.php');
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <form action="" method="POST">
        <label for="title">Titre : </label><input type="text" id="title" name="title" value="<?= $title ?? null ?>">
        <?= $errors['title'] ?? null; ?></br>
        <label for="kind">Genre : </label><input type="text" id="kind" name="kind" value="<?= $kind ?? null ?>">
        <?= $errors['kind'] ?? null; ?></br>
        <label for="published_at">Published_at : </label><input type="date" id="published_at" name="published_at" value="<?= $published_at ?? null ?>">
        <?= $errors['published_at'] ?? null; ?></br>

        <button type="submit">Ajouter le livre</button>
    </form>

</body>

</html>