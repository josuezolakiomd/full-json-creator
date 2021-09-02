<?php session_start();
require_once('config.php');

$id = filter_input(INPUT_GET, 'id');

$data = [];

if ($id) {
  $sql = $pdo->prepare("SELECT * FROM users WHERE id = :id");
  $sql->bindValue(':id', $id);
  $sql->execute();

  if($sql->rowCount() > 0) {
    $data = $sql->fetch(PDO::FETCH_ASSOC);
  } else {
    header('Location: index.php');
    exit;
  }
} else {
  header('Location: index.php');
  exit;
}
?>

<head>
  <link rel="stylesheet" href="assets/style.css" />
</head>

<body style="display: flex; align-items: center; justify-content: center; background: #333;">
<form class="form" method="POST" action="edit_action.php">
  <h1> JSON Creator - Update</h1>
  <input type="hidden" name="id" value="<?= $data['id']?>" >

  <input type="text" placeholder="Type your name..." name="name" class="name" value="<?= $data['name']?>">
  <input type="text" placeholder="Type your username account..." name="username" class="username" value="<?= $data['username']?>">
  <input type="email" placeholder="Type your email address..." name="email" class="email" value="<?= $data['email']?>">

  <input type="submit" class="btn" value="Salve" /> 
</form>
</body>