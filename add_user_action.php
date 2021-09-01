<?php session_start();
require_once('config.php');

$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$dob = filter_input(INPUT_POST, 'dob');

if($name && $username && $email && $dob) {
  $username = strtolower(str_replace(" ", "", $username)); 
  $dob = substr($dob, 0, 4);

  $sql = $pdo->prepare("INSERT INTO users (name, username, email, dob) VALUES (:name, :username, :email, :dob)");

  $sql->bindValue(':name', $name);
  $sql->bindValue(':username', $username);
  $sql->bindValue(':email', $email);
  $sql->bindValue(':dob', $dob);
  $sql->execute();

  header('Location: index.php');
  exit; 
} else {
  echo "Erro";
}

 
