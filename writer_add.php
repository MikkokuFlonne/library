<?php
require 'config/DB.php';


function formatDate($date, $format = '%d %B %Y') {
    setlocale(LC_ALL, 'fr.utf-8');

    return strftime($format, strtotime($date));
}

$firstname = $_POST['firstname'] ?? null;
$lastname = $_POST['lastname'] ?? null;
$birthday = $_POST['birthday'] ?? null;

$errors= [];

var_dump($_POST);

if(!empty($_POST)){

    if(strlen($firstname) < 1){
        $errors['firstname'] = 'Le titre n\'est pas assez long.';
    }
    if(strlen($lastname) < 1){

        $errors['lastname']= 'Le genre n\'est pas assez long.';
    }

    $month = formatDate($birthday, '%m');
    $day = formatDate($birthday, '%d');
    $year = formatDate($birthday, '%Y');

    if ($birthday !== formatDate($birthday, '%Y-%m-%d') || !checkdate($month, $day, $year)){

        $errors['birthday'] = 'La date n\'est pas valide';
    }

    if(empty($errors)){
        $query = DB::postQuery('INSERT INTO writer (firstname, lastname, birthday) VALUES (:firstname, :lastname, :birthday)', $_POST);

        header('writer_add.php');
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
<label for="firstname">Prénom : </label><input type="text" id="firstname" name="firstname" value="<?= $firstname ?? null ?>">
<?= $errors['firstname'] ?? null;?></br>
<label for="lastname">Nom : </label><input type="text" id="lastname" name="lastname" value="<?= $lastname ?? null ?>">
<?= $errors['lastname'] ?? null;?></br>
<label for="birthday">Birthday : </label><input type="date" id="birthday" name="birthday" value="<?= $birthday ?? null ?>">
<?= $errors['birthday'] ?? null;?></br>

<button type="submit">Ajouter l'auteur</button>
</form>
    
</body>
</html>