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

echo '<h1>inner</h1>';

$sql = "SELECT trees.id as tid, trees.name as tname, tipai.name as tpname
FROM trees
INNER JOIN tipai
ON trees.type = tipai.id;";

$stmt = $pdo->query($sql);

while ($row = $stmt->fetch())
{
    echo $row['tid'] .'. '. $row['tpname'] .' ' .$row['tname'] . "<br>";
} //MATYSIM PASKUTYNES LENTELES TREEES ID



