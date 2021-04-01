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

$sql = 'SELECT name, height, id FROM trees';
$stmt = $pdo->query($sql);

while ($row = $stmt->fetch())
{
    echo $row['id'] .'. '. $row['name'] .' '. $row['height'] . "<br>";
}

echo '<h1>Lapuociai</h1>';

$sql =
"SELECT name, height, id
FROM trees
WHERE type = 2";

$stmt = $pdo->query($sql);

while ($row = $stmt->fetch())
{
    echo $row['id'] .'. '. $row['name'] .' '. $row['height'] . "<br>";
}

echo '<h1>Viskas pagal auksti</h1>';

$sql = 'SELECT name, height, id FROM trees ORDER BY height DESC'; //su desc bus atvyrkstine tvarka
$stmt = $pdo->query($sql);

while ($row = $stmt->fetch())
{
    echo $row['id'] .'. '. $row['name'] .' '. $row['height'] . "<br>";
}

///trynimas
$sql = "DELETE FROM trees WHERE name='Ąžuolas'";
$pdo->query($sql);



///irasymas
$sql = "INSERT INTO trees (name, height, type)
VALUES ('Ąžuolas', 7.99, 2)";
$pdo->query($sql);


//redagavimas
$sql = "UPDATE trees SET height=88.88 WHERE name='Kastonas'";
$pdo->query($sql);


















?>