<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

$email = $_POST["email"];
$password = $_POST["password"];


// *** HASHING PASSWORD
$options = [
    "cost" => 12
];
$hashedPSWRD = password_hash($password, PASSWORD_BCRYPT, $options);

// 
// 
try {
require "db.inc.php";

$query = "INSERT INTO users (email, pswrd) VALUES (?,?)";

$stmt = $pdo->prepare($query);

$stmt->execute([$email, $hashedPSWRD]);


// resetting
$pdo = null;
$stmt = null; 

// bringing back the user
    header("Location: ../testing.php");


} catch (PDOException $e) {
    die("errore nel db" . $e->getMessage());
}
}

else{
    header("Location: ../testing.php");
}