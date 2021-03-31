<?php
require 'connec.php';
require 'form.php';



function addFriend(array $storyData)

{
    $pdo = new PDO(DSN, USER, PASS);
    $firstname = trim($storyData['firstname']);
    $lastname = trim($storyData['lastname']);
    $query = "INSERT INTO friend (firstname, lastname) VALUES (:firstname, :lastname)";
    $statement = $pdo->prepare($query);
    $statement->bindValue(':lastname', $lastname);
    $statement->bindValue(':firstname', $firstname);
    $statement->execute();
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    addFriend($_POST);
}

function showAll(): array
{
    $pdo = new PDO(DSN, USER, PASS);
    $query = "SELECT * FROM friend";
    $statement = $pdo->query($query);
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

var_dump(showAll());

$friends = showAll();

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
    <ul>
        <?php foreach ($friends as $friend) : ?>
            <li>
                <?= $friend['firstname']; ?>
                <?= $friend['lastname']; ?>
            </li>
        <?php endforeach; ?>
    </ul>
</body>

</html>