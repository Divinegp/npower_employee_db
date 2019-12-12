<?php
  require_once('parsers/config.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Home Admin Pannel</title>

  <link rel="stylesheet" href="./assets/css/bootstrap.css">
  <link rel="stylesheet" href="./assets/css/cover.css">
</head>
<body class="text-center">
<div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
  <header class="masthead mb-auto">
    <div class="inner">
      <h3 class="masthead-brand">
        <a class="nav-link active" href="index.php">Home</a>
      </h3>

      <nav class="nav nav-masthead justify-content-center">
        <a class="nav-link" href="dashboard.php">Admin Pannel</a>
        <?php if (isset($_SESSION['username'])){ ?>
          <a class="nav-link" href="views/users/profile.php?user_id=<?= $_SESSION['user_id'] ?>"><?= $_SESSION['username'] ?></a>
          <a class="nav-link" href="views/users/logout.php">
            <small class="btn btn-sm btn-danger">Sign out</small>
          </a>
        <?php } ?>
      </nav>
    </div>
  </header>

  <main role="main" class="inner cover"> 
        <img src="assets/images/npower.png">
    <h1 class="cover-heading">Employee Website</h1>
    <p class="lead">
      Employee management system <br>
      NPower Project 2!<br>
      👌
      <!-- .
    Cover is a one-page template for building simple and beautiful home pages. Download, edit the text, and add your own fullscreen background photo to make it your own. --></p>
      <p class="lead">
        <?php if (isset($_SESSION['username'])){ ?>

          <span class="h1">Current User: <strong class="shadow shadow-sm"><?= $_SESSION['username'] ?></strong></span>

        <?php 
          } else { 
        ?>
        <ul class="list-inline">
          <li class="list-inline-item"><a href="./views/users/login.php" class="btn btn-lg btn-info">Login</a></li>
          <li class="list-inline-item"><a href="./views/users/register.php" class="btn btn-lg btn-danger">Register</a></li>          
        </ul>
        <?php } ?>
      </p>

    <?php 
      if (isset($_SESSION['message'])){

        echo '<div class="container"><div class="alert alert-info p-1 text-center">';
        echo $_SESSION['message'];
        echo '</div></div>';

        unset($_SESSION['message']);
      }
    ?> 
  </main>

  <footer class="mastfoot mt-auto">
    <div class="inner">
      <p>Powered by Ojobor, Jude Ikechukwu <br> @ N-Power Tech Software 2019</p>
    </div>
  </footer>
</div>

<?php include_once('./inc/footer.php'); ?>
</body>
</html>