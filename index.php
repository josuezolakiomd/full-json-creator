<?php session_start();
require_once('config.php'); 

$sql = $pdo->query("SELECT * FROM users");
$allUsers = $sql->fetchAll(PDO::FETCH_ASSOC);

function calcAge($dob) {
  $currentYear = date('Y');
 return $currentYear - $dob;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/style.css">
  <title>JSON Creator - PHP</title>
</head>

<body>

  <div class="Container">
    <div class="info">
      <span class="span">Atenção!</span>
      <p>
        {
        <span class="rules">O primeiro usuário deverá ser cadastrado novamente!..</span>
        }
      </p>
    </div>

    <form class="form" method="POST" action="add_user_action.php">
      <h1> JSON Creator </h1>
      <input type="text" placeholder="Type your name..." name="name" class="name">
      <input type="text" placeholder="Type your username account..." name="username" class="username">
      <input type="email" placeholder="Type your email address..." name="email" class="email">
      <input type="date" name="dob" class="dob">
      <input type="submit" class="btn" value="Create User" /> 
    </form>

    <div class="Users"> 
      <h3>
        <span class="usersTitle">
          <?php 
          if(count($allUsers) > 1) {
            echo "Users";
          } else {
            echo "User";
          }
          ?>
        </span>
        <span class="allUsers"> 
          <?php 
          if(count($allUsers) > 1) {
            echo count($allUsers);
          } else {
            echo "0";
          }
          ?>
          </span>
      </h3>

      <div class="usersJson">
          <?php foreach($allUsers as $user): ?>
            <ul>
              <li class='title'><?= $user['name']?></li>
              <li> <span>Email:</span> <?= $user['email']?></li>
              <li> <span>Username:</span> <?= $user['username']?></li>
              <li class='date'> <?= calcAge($user['dob']) ?> years old</li>
              <li class='close'>-</li>
              <li class='edit'>+</li>
            </ul>
          <?php endforeach ?>  
      </div>
    </div>

    <p class="author">Created with 💖 by <span>Josué Zolakio</span></p>

    <div class="credits">Ícones feitos por <a href="https://smashicons.com/" title="Smashicons">Smashicons</a> from <a
        href="https://www.flaticon.com/br/" title="Flaticon">www.flaticon.com</a></div>
  </div>
</body>

</html>