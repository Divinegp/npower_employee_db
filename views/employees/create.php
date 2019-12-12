<?php

  require_once('../../parsers/config.php');

  // Check if user is a guest.
  confirm_logged_in();

  $sql = "SELECT * FROM users";
  $stmt = $conn->query($sql);

  $sql = "SELECT * FROM qualification";
  $stmt2 = $conn->query($sql);
  if ($stmt2->num_rows > 0) {
    $q_row = $stmt2->fetch_assoc();
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Update Employee Detail</title>

  <link rel="stylesheet" href="../../assets/css/bootstrap.css">
  <link rel="stylesheet" href="../../assets/css/signin.css">
  <link rel="stylesheet" href="../../assets/css/dashboard.css">
  <link rel="stylesheet" href="../../assets/css/custom.css">
</head>
<body>
  <?php include_once('../../inc/nav.php'); ?>

  <div class="container">

    <div class="row">
      <div class="d-block my-5">&nbsp;</div>
      <div class="d-block my-5">&nbsp;</div>
    </div>
    <div class="row">
      <div class="d-block my-5">&nbsp;</div>
      <div class="d-block my-5">&nbsp;</div>
    </div>

    <div class="row">
      <div class="col-md-8 offset-2 mb-3">
        <div class="border bg-white rounded">
          <form action="../../parsers/insert_employee.php" method="POST" class="form-signin">
            <h1 class="h3 mb-3 font-weight-normal">Add Employee Info</h1>

            <label for="user_id" class="">Employee</label>
            <select name="user_id" id="user_id" class="form-control">
              <option value="">Select The Employee</option>
              <?php            
                if($stmt->num_rows > 0) {
                  while($res = $stmt->fetch_assoc()) {
                ?>
                  <option value="<?= $res['id'] ?>"><?= $res['username'] ?></option>
                <?php
                  }
                }
              ?>
            </select>
            <br>

            <label for="firstname" class="">Firstname</label>
            <input name="fname" type="text" id="firstname" class="form-control" placeholder="Firstname" required="" autofocus="">
            <br>

            <label for="lastname" class="">Lastname</label>
            <input name="lname" type="text" id="lastname" class="form-control" placeholder="Lastname" required="">
            <br>

            <label for="salary" class="">salary</label>
            <input name="salary" type="text" id="salary" class="form-control" placeholder="Salary" required="">
            <br>
            
            <label for="dob" class="">Date of Birth</label>
            <input name="dob" type="date" id="dob" class="form-control" placeholder="yyyy-mm-dd" required="">
            <br>
            
            <label for="djoined" class="">Date Employee Joined</label>
            <input name="djoined" type="date" id="djoined" class="form-control" placeholder="yyyy-mm-dd" required="">
            <br>

            <label for="qual_id" class="">Qualifications</label>
            <select name="qual_id" id="qual_id" class="form-control">
              <option value="">Select Qualification</option>
              <?php            
                if($stmt2->num_rows > 0) {
                  while($row = $stmt2->fetch_assoc()) {
                ?>
                  <option value="<?= $row['id'] ?>"><?= $row['title'] ?></option>
                <?php
                  }
                }
              ?>
            </select>
            <br>

            <button name="submit_btn" class="btn btn-lg btn-primary btn-block" type="submit">Save Data</button>
          </form>
        </div>
      </div>
    </div>

    <p class="mt-5 mb-3 text-muted">© 2019</p>
  </div><!-- /.container -->

  <?php include_once('../../inc/footer.php'); ?>
</body>
</html>