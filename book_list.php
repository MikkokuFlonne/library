<?php
require 'config/DB.php';

$books = DB::query('SELECT * from book');

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

        <?php foreach($books as $index=>$book){ 
            if($index == 0){?>
                            <tr>
                <?php foreach(get_object_vars($book) as $key =>$livre){?>

                    <th><?=$key?></th>
                    
                <?php
                }?>
                <th>Actions</th>
                </tr>
        
        <?php }?>

        <tr>
            
            <td><?=$book->id?></td>
            <td><?=$book->title?></td>
            <td><?=$book->kind?></td>
            <td><?=$book->published_at?></td>
            <td>
            <button name="edit">Modifier</button>
            <button name="delete">Supprimer</button>
            </td>
        </tr>
        <?php }?>
    </table>



</body>

</html>