<?php
require 'config/DB.php';

var_dump($_POST);

$books = DB::query('SELECT * from book');
$writers = DB::query('SELECT * from writer');

$book_id = $_POST['book_id'] ?? null;
$writer_id = $_POST['writer_id'] ?? null;

$entries = DB::query('SELECT * from writer_write_book');

$errors = [];
$error = [];


if (!empty($_POST)) {
    $checkBook_id = false;
    $checkWriter_id = false;

    foreach ($books as $book) {
        if ($book_id == $book->id) {
            $checkBook_id = true;
        }
    }

    foreach ($writers as $writer) {
        if ($writer_id != $writer->id) {
            $checkWriter_id = true;
        }
    }

    if (!$checkBook_id) {
        $errors['book_id'] = 'Ce livre n\'existe pas.';
    }
    if (!$checkWriter_id) {
        $errors['writer_id'] = 'Cet auteur n\'existe pas.';
    }

    if (empty($errors)) {
        foreach ($entries as $entry) {
            if (($book_id == $entry->book_id) && ($writer_id == $entry->writer_id)) {
                $error['entry'] = 'Cette combinaison est déjà enregistrée';
            }
        }
        if (empty($error)) {
            $query = DB::postQuery('INSERT into writer_write_book (book_id, writer_id) VALUES (:book_id, :writer_id)', $_POST);
            header('Location: writer_write_book_add.php');
        }
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
        <label for="book_id">Nom du livre : </label><select name="book_id" id="book_id">
            <?php foreach ($books as $book) { ?>
                <option value="<?= intval($book->id) ?>"><?= $book->title ?></option>
            <?php
            } ?>
        </select>
        <?= $errors['book_id'] ?? null ?>

        <label for="writer_id">Auteur : </label><select name="writer_id" id="writer_id">
            <?php foreach ($writers as $writer) { ?>
                <option value="<?= intval($writer->id) ?>"><?= $writer->firstname . ' ' . $writer->lastname ?></option>
            <?php
            } ?>
        </select>
        <?= $errors['writer_id'] ?? null ?>

        <button type="submit">Envoyer</button>
    </form>
    <?= $error['entry'] ?? null ?>

</body>

</html>