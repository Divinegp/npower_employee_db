<?php
  require_once('../../parsers/config.php');

  confirm_logged_in();

  $stmt = userEmployeeQuery(null, $_GET['user_id']);
  if($stmt->num_rows > 0) {
    $row = $stmt->fetch_assoc();
  }
  else {
    $_SESSION['message'] = 'User not found.';
    header( 'Location: ../../index.php' );
  }
  // echo '<pre>';
  // print_r($_SESSION);
  // echo "----****----";
  // print_r($row);
  // echo '</pre>';
  // die();

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Edit User Profile</title>
  <link rel="stylesheet" href="../../assets/css/bootstrap.css">
  <link rel="stylesheet" href="../../assets/css/dashboard.css">
  <!-- <link rel="stylesheet" href="../../assets/css/signin.css"> -->
  <!-- <link rel="stylesheet" href="../../assets/css/cover.css"> -->
  <style>
    .info_tab {
      display: inline-block;
      width: 100px;
      font-weight: bold;
    }
  </style>
</head>
<body>
  <?php include_once('../../inc/nav.php'); ?>
  
  <div class="row">
    <div class="col-md-3">
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

    <div class="col-md-7">
      <div class="card text-center">
        <div class="card-header">
          <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Profile</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
            </li>
          </ul>
        </div>
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <div class="card-body">
              <h5 class="card-title">Add Employee Info</h5>
              <!-- 
                <?php if (isset($row['firstname'])) { ?>
                <a href="../employees/edit.php?user_id=<?= $row['user_id'] ?>" class="btn btn-primary">Add Info</a>
                <?php } else { ?>
                <a href="../employees/create.php?user_id=<?= $row['user_id'] ?>" class="btn btn-primary">Update Info</a>
                <?php } ?> 
              -->
            </div>
          </div>
          <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">            
            <div class="card-body">
              <h5 class="card-title">My 411?</h5>
              <p class="card-text">All you need to know about ME!</p>
            </div>
          </div>
          <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">            
            <div class="card-body">
              <h5 class="card-title">Contact Me</h5>
              <p class="card-text">You need a great service? Let's connect...</p>
              <ul>
                <li>Email: divinegpc@gmail.com</li>
                <li>Phone: +2348061599859</li>
                <li>Twitter: @divine</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <div class="col-md-2">
      <div class="border rounded p-2">
          <div class="nav flex-column nav-pills" aria-orientation="vertical">
            <a class="nav-link btn-outline-primary my-1" href="../../dashboard.php" aria-controls="v-pills-home" aria-selected="true">Dashboard</a>
            <a class="nav-link btn-outline-primary my-1" href="../../views/users/edit.php?user_id=<?= $row['user_id']?>" aria-controls="v-pills-profile" aria-selected="false">Edit Info</a>
            <a class="nav-link btn-outline-primary my-1" href="../../views/employees/edit.php?user_id=<?= $row['user_id']?>" aria-controls="v-pills-profile" aria-selected="false">Edit Employee</a>
          </div>
      </div>
    </div>
  </div>

  <?php include_once('../../inc/footer.php'); ?>
</body>
</html>