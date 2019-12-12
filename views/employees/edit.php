<?php

  require_once('../../parsers/config.php');

  // Check if user is a guest.
  confirm_logged_in();

  $user_id = $_GET['user_id'];//get_user_id();

  $stmt = userEmployeeQuery(null, $user_id);
  
  if ($stmt->num_rows > 0) {
    $row = $stmt->fetch_assoc();
  }
  else {
    $_SESSION['message'] = 'Employee not found.';
    header( 'Location: ../../index.php' );
  }

  // Retrieve All Qualification Entries.
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

  <div class="row">
    <div class="d-block my-5">&nbsp;</div>
    <div class="d-block my-5">&nbsp;</div>
  </div>
  <div class="row">
    <div class="d-block my-5">&nbsp;</div>
    <div class="d-block my-5">&nbsp;</div>
  </div>
  <div class="row">
    <div class="d-block my-5">&nbsp;</div>
    <div class="d-block my-5">&nbsp;</div>
  </div>

  <div class="row">
    <div class="col-md-4 mb-3">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title"><?= $row['username'] ?></h5>
          <p class="card-text"><?= $row['firstname'] ." ". $row['lastname'] ?>
        </div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item"><span class="info_tab">Email:</span> <?= $row['email'] ?></li>
          <li class="list-group-item"><span class="info_tab">Salary:</span> <?= $row['salary'] ?></li>
          <li class="list-group-item"><span class="info_tab">Birth Date:</span> <?= $row['dob'] ?></li>
          <li class="list-group-item"><span class="info_tab">Joined Date:</span> <?= $row['date_joined'] ?></li>
          <li class="list-group-item"><span class="info_tab">Qualification:</span> <?= $row['emq_title'] ?></li>
        </ul>
      </div>
    </div>

    <div class="col-md-8 mb-3">
      <div class="border bg-white rounded">
        <form action="../../parsers/update_employee.php" method="POST" class="form-signin">
          <h1 class="h3 mb-3 font-weight-normal">Update Employee Info</h1>

          <label for="ffname" class="">Employee</label>
          <input value="<?= $row['firstname'] ?> <?= $row['lastname'] ?> - <?= $row['username'] ?>" type="text" id="ffname" class="form-control" required="" disabled>
          <br>

          <label for="firstname" class="">Firstname</label>
          <input value="<?= $row['firstname'] ?>" name="fname" type="text" id="firstname" class="form-control" placeholder="Firstname" required="" autofocus="">
          <br>

          <label for="lastname" class="">Lastname</label>
          <input value="<?= $row['lastname'] ?>" name="lname" type="text" id="lastname" class="form-control" placeholder="Lastname" required="">
          <br>

          <label for="salary" class="">salary</label>
          <input value="<?= $row['salary'] ?>" name="salary" type="text" id="salary" class="form-control" placeholder="Salary" required="">
          <br>
          
          <label for="dob" class="">Date of Birth</label>
          <input value="<?= $row['dob'] ?>" name="dob" type="text" id="dob" class="form-control" placeholder="YYYY-mm-dd" required="">
          <br>
            
          <label for="djoined" class="">Date Employee Joined</label>
          <input value="<?= $row['date_joined'] ?>" name="djoined" type="text" id="djoined" class="form-control" placeholder="YYYY-mm-dd" required="">
          <br>

          <label for="qual_id" class="">Qualifications</label>
          <select name="qual_id" id="qual_id" class="form-control">
            <option value="">Select Qualification</option>
            <?php            
              if($stmt2->num_rows > 0) {
                while($q_row = $stmt2->fetch_assoc()) {
              ?>
                <option value="<?= $q_row['id'] ?>" 
                  <?php if (!is_null($row['qualification_id']) && ($row['qualification_id'] == $q_row['id'])) { echo "selected";} ?>><?= $q_row['title'] ?></option>
              <?php
                }
              }
            ?>
          </select>
          <br>
          <input name="user_id" type="hidden" id="user_id" value="<?= $user_id ?>">

          <button name="btn_update" class="btn btn-lg btn-primary btn-block" type="submit">Save Data</button>
        </form>
      </div>
    </div>
  </div>

  <p class="mt-5 mb-3 text-muted">© 2019</p>

  <?php include_once('../../inc/footer.php'); ?>
</body>
</html>