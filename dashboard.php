<?php
  require_once('parsers/config.php');

  // Check if user is a guest.
  confirm_logged_in();

  $user_id = get_user_id();

  // Retrieve User Details
    $sql  = "SELECT u.id AS user_id, u.username, u.email, e.firstname, e.lastname, e.salary, e.dob, e.date_joined, q.title As emq_title";
    $sql .= " FROM users As u";
    $sql .= " LEFT JOIN employees_table AS e ON u.id = e.user_id";
    $sql .= " LEFT JOIN qualification AS q ON q.id = e.qualification_id";
    $stmt = $conn->query($sql);

  # Employee Counts/Qualification SQL
    $sql_qc  = "SELECT COUNT(*) AS qualification_count, AVG(salary) AS avg_salary, q.title";
    $sql_qc .= " FROM employees_table As e";
    $sql_qc .= " LEFT JOIN qualification AS q ON q.id = e.qualification_id";
    $sql_qc .= " GROUP BY qualification_id";
    $stmt_qc = $conn->query($sql_qc);

  # Users Count SQL
    $sql_user  = "SELECT COUNT(*) AS users_count";
    $sql_user .= " FROM users";
    $stmt_user = $conn->query($sql_user);
    $u_count = $stmt_user->fetch_assoc();

  # Employees Count SQL
    $sql_em  = "SELECT COUNT(*) AS employees_count";
    $sql_em .= " FROM employees_table";
    $stmt_em = $conn->query($sql_em);
    $e_count = $stmt_em->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">

  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="./assets/css/bootstrap.css">
  <link rel="stylesheet" href="./assets/css/dashboard.css">
</head>
<body>
  <?php include_once('./inc/nav_2.php'); ?>

  <div class="container-fluid">
    <div class="row mb-5">
      <nav class="col-md-2 d-none d-md-block bg-light sidebar">
        <div class="sidebar-sticky">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link active" href="#">
                <span data-feather="menu"></span>
                Dashboard <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <span data-feather="users"></span>
                Users
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <span data-feather="bar-chart-2"></span>
                Stats
              </a>
            </li>
          </ul>

          <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>Admin Area</span>
            <a class="d-flex align-items-center text-muted" href="#" aria-label="Add a new report">
              <span data-feather="plus-circle"></span>
            </a>
          </h6>
          <ul class="nav flex-column mb-2">
            <li class="nav-item">
              <a class="nav-link" href="#">
                <span data-feather="file-text"></span>
                Settings
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <span data-feather="file"></span>
                ...
              </a>
            </li>
          </ul>
        </div>
      </nav>

      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2">Employee Dashboard</h1>
          <a href="views/employees/create.php" class="h4">+ New Employee</a>
        </div>

        <div class="container text-center">
          <div class="row">
            <canvas class="my-4 col-lg-6" id="myChart"></canvas>

            <div class="my-4 col-lg-6" id="statArea">
              <div class="container">

                <div class="row">
                  <div class="col-md-5">
                    <div class="card mb-2">
                      <div class="card-body">
                        <p class="h1 font-weight-bold lead">
                          <?= number_format($u_count['users_count']) ?>
                        </p>
                      </div>
                      <div class="card-footer">
                        Users Count
                      </div>
                    </div>
                    <div class="card mb-2">
                      <div class="card-body">
                        <p class="h1 font-weight-bold lead">
                          <?= number_format($e_count['employees_count']) ?>
                        </p>
                      </div>
                      <div class="card-footer">
                          Employees Count
                      </div>
                    </div>
                  </div>

                  <div class="col-md-7">
                    <div class="card mb-2">
                      <div class="table-responsive">
                        <h5 class="p-2">Employee Statistics</h5>
                        <table class="table table-striped table-sm">
                          <thead>
                            <tr>
                              <th title="Qualification Title">Qual.</th>
                              <th title="Employees Count">Count</th>
                              <th title="Average Salary/Qualification">Avg. Salary</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                              if($stmt_qc->num_rows > 0) {
                                while($row = $stmt_qc->fetch_assoc()) {
                                  echo '<tr><td>';
                                  echo $row['title'];
                                  echo '</td><td>';
                                  echo $row['qualification_count'];
                                  echo '</td><td>';
                                  echo number_format($row['avg_salary']);
                                  echo '</td></tr>';
                                }
                              }
                            ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <h2>All Employee Records</h2>
    
        <div class="table-responsive text-center">
          <table class="table table-striped table-sm">
            <thead>
              <tr>
                <th>Username</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Salary</th>
                <th>Date Of Birth</th>
                <th>Date Joined</th>
                <th>Qualification</th>
                <th>Email</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
                if($stmt->num_rows > 0) {
                  while($row = $stmt->fetch_assoc()) {
                    echo '<tr><td class="text-left">';
                    echo $row['username'];
                    echo '</td><td>';
                    echo $row['firstname'];
                    echo '</td><td>';
                    echo $row['lastname'];
                    echo '</td><td>';
                    echo $row['salary'];
                    echo '</td><td>';
                    echo $row['dob'];
                    echo '</td><td>';
                    echo $row['date_joined'];
                    echo '</td><td>';
                    echo $row['emq_title'];
                    echo '</td><td>';
                    echo $row['email'];
                    echo '</td><td>';
                    echo '<a href="views/employees/edit.php?user_id='. $row['user_id'] .'">Update</a> | <a href="views/employees/delete.php?user_id='. $row['user_id'] .'">Delete</a>';
                    echo '</td></tr>';
                  }
                }
              ?>
            </tbody>
          </table>
        </div>
      </main>
    </div>
  </div>


<?php include_once('./inc/footer.php'); ?>
<script src="./assets/js/feather-icons.js"></script>
<script src="./assets/js/chart.js"></script>
<script src="./assets/js/dashboard.js"></script>
</body>
</html>