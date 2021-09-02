<?php session_start();
require_once('config.php');

$id = filter_input(INPUT_POST, 'id');
$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

if($id && $name && $username && $email) {
  $username = strtolower(str_replace(" ", "", $username));
  
  $sql = $pdo->prepare("UPDATE users SET name = :name, username = :username, email = :email WHERE id = :id");
  $sql->bindValue(':name', $name);
  $sql->bindValue(':username', $username);
  $sql->bindValue(':email', $email);
  $sql->bindValue(':id', $id);
  $sql->execute();

  header('Location: index.php');
  exit; 
} else {
  header('Location: edit.php');
  exit;
}