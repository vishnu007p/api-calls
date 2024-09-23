<?php
header('Content-Type:application/json');

$host = '127.0.0.1';
$dbname = 'sample';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;port=3307;dbname=$dbname", $username,$password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = "SELECT users.name FROM users JOIN gender ON users.id = gender.id WHERE gender.gender = 'male'";
    $stmt = $pdo->prepare($query);
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($result);
}catch(PDOException $e) {
    echo json_encode(["error"=> $e->getMessage()]);
}
?>