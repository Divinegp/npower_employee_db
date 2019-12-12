<?php
  require_once('../../parsers/config.php');
  
  is_logged_in();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Register</title>

  <link rel="stylesheet" href="../../assets/css/bootstrap.css">
  <link rel="stylesheet" href="../../assets/css/signin.css">
  <link rel="stylesheet" href="../../assets/css/dashboard.css">
  <link rel="stylesheet" href="../../assets/css/custom.css">
</head>
<body>
  <?php include_once('../../inc/nav.php'); ?>
  
  <form action="../../parsers/insert_user.php" method="POST" class="form-signin">
    <h1 class="h3 mb-3 font-weight-normal">Register</h1>

    <label for="username" class="">Username</label>
    <input name="uname" type="text" id="username" class="form-control" placeholder="Username" required="" autofocus="" autocomplete="off">
    <br>

    <label for="password" class="">Password</label>
    <input name="password" type="password" id="password" class="form-control" placeholder="Password" required="" autocomplete="off">
    <br>

    <label for="email" class="">Email address</label>
    <input name="email" type="email" id="email" class="form-control" placeholder="Email address" required="" autocomplete="off">
    <br>

    <button name="submit_btn" class="btn btn-lg btn-info btn-block" type="submit">Sign Up</button>

    
    <p class="mt-5 mb-3 text-muted">Powered by Ojobor, Jude Ikechukwu <br> @ N-Power Tech Software 2019</p>
  </form>

  <?php include_once('../../inc/footer.php'); ?>
</body>
</html>