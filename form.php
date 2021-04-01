<?php

$host = '127.0.0.1';
$db   = 'forest';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
try {
     $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
     throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

if(!empty($_POST)) {

    if('add' == $_POST['action']) {
        // $sql = "INSERT INTO trees (name, height, type)       KABUCIU KARAI
        // VALUES ('".$_POST['name']."', ".$_POST['height'].", ".$_POST['type'].")";
        // $pdo->query($sql);

        $sql = "INSERT INTO trees (name, height, type)
        VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql); //paruosimas
        $stmt->execute([ $_POST['name'], $_POST['height'], $_POST['type'] ]);


        // $sql = "INSERT INTO trees (name, height, type)       KITOKS BUDAS
        // VALUES (:name, :h, :type)";// <--- sql formavimas
        // $stmt = $pdo->prepare($sql); // paruosimas
        // $stmt->execute([ 'type'=>$_POST['type'], 'name'=>$_POST['name'], 'h'=>$_POST['height']    ]); // vykdymas
    }

    if('delete' == $_POST['action']) {
        $sql = "DELETE FROM trees WHERE id=?"; //sql formavimas
        $stmt = $pdo->prepare($sql); //paruosimas
        $stmt->execute([$_POST['id']]); //vykdymas

        // $sql = "DELETE FROM trees WHERE id=".$_POST['id']."";
        // $pdo->query($sql);

        //kada nauduoti query? Tik su SAUGIOM UZKLAUSOM, kai rankos i hardcodinta
        //prepare ir execute yra del SAUGUMO
    }



    header('Location: http://localhost/db/form.php');
    die;
}

?>

<form action="" method="post">
    Name:<input type="text" name="name">
    Type:<input type="text" name="type">
    Height:<input type="text" name="height">
    <button type="submit" name="action" value="add">Sodinti</button>
</form>
<hr>

<form action="" method="post">
    Id:<input type="text" name="id">
    <button type="submit" name="action" value="delete">Israuti</button>
</form>

<?php
$sql = 'SELECT name, height, id FROM trees';
$stmt = $pdo->query($sql);

while ($row = $stmt->fetch())
{
    echo $row['id'] .'. '. $row['name'] .' '. $row['height'] . "<br>";
}