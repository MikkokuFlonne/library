<?php
require 'config/DB.php';

$books = DB::query('SELECT * from book');

if (isset($_POST['edit'])) {
    header('Location: book_edit.php');
}
if (isset($_POST['delete'])) {
    var_dump($_POST);
    $delete = DB::query('DELETE FROM book WHERE id = :id', ["id"=> $_POST['delete']]);
    $delete = DB::query('DELETE FROM writer_write_book WHERE book_id = :id', ["id"=> $_POST['delete']]);
    header('Location: book_list.php');
    
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library</title>
</head>

<body>

    <table>

        <?php foreach ($books as $index => $book) {
            if ($index == 0) { ?>
                <tr>
                    <?php foreach (get_object_vars($book) as $key => $livre) { ?>

                        <th><?= $key ?></th>

                    <?php
                    } ?>
                    <th>Actions</th>
                </tr>

            <?php } ?>

            <tr>

                <td><?= $book->id ?></td>
                <td><?= $book->title ?></td>
                <td><?= $book->kind ?></td>
                <td><?= $book->published_at ?></td>
                <td>
                    <form action="" method="POST">
                        <button name="edit" value="<?=$book->id?>">Modifier</button>
                        <button name="delete" value="<?=$book->id?>">Supprimer</button>
                    </form>
                </td>
            </tr>
        <?php } ?>
    </table>



</body>

</html>