<link rel="stylesheet" href="assets/style.css">

<?php session_start();
require_once('config.php');

$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$dob = filter_input(INPUT_POST, 'dob');

// user
$sqlUser = $pdo->query("SELECT * FROM users");
$user = $sqlUser->fetchAll(PDO::FETCH_ASSOC);
print_r($user);

// name_validation_action
$sqlName = $pdo->prepare("SELECT * FROM users WHERE name = :name");
$sqlName->bindValue(':name', $name);
$sqlName->execute();

// email_validation_action
$sqlEmail = $pdo->prepare("SELECT * FROM users WHERE email = :email");
$sqlEmail->bindValue(':email', $email);
$sqlEmail->execute();

// username_validation_action
$sqlUsername = $pdo->prepare("SELECT * FROM users WHERE username = :username");
$sqlUsername->bindValue(':username', $username);
$sqlUsername->execute();

// db_informations_for_validation
$userName = $sqlName->fetchAll(PDO::FETCH_ASSOC);
$userEmail = $sqlEmail->fetchAll(PDO::FETCH_ASSOC);
$user_name = $sqlUsername->fetchAll(PDO::FETCH_ASSOC);

if($name && $username && $email && $dob) {
  $username = strtolower(str_replace(" ", "", $username)); 
  $dob = substr($dob, 0, 4);

  if(!$sqlName && !$sqlEmail && !$sqlUsername) {
    $sql = $pdo->prepare("INSERT INTO users (name, username, email, dob) VALUES (:name, :username, :email, :dob)");

    $sql->bindValue(':name', $name);
    $sql->bindValue(':username', $username);
    $sql->bindValue(':email', $email);
    $sql->bindValue(':dob', $dob);
    $sql->execute();
  } else if (Count($user) == 0) {
    $sql = $pdo->prepare("INSERT INTO users (name, username, email, dob) VALUES (:name, :username, :email, :dob)");

    $sql->bindValue(':name', $name);
    $sql->bindValue(':username', $username);
    $sql->bindValue(':email', $email);
    $sql->bindValue(':dob', $dob);
    $sql->execute();
  } else {
    $alertSms = "User Already exists!";
    $_SESSION['alert'] = $alertSms;
  }

  header('Location: index.php');
  exit;
} else {
  header('Location: index.php');
  exit;
}

 
