<?php
    session_start();

    // To make PHP and MySQL connections
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'employee_db';

    $conn = new mysqli($host, $username, $password, $dbname);

    if ($conn->connect_error) {
        die('Connection failed! ' . $conn->connect_error);
    }

    function dd($var) {
      # Die Dump!
      echo "<pre>";
      print_r($var);
      echo "</pre>";
      die();
    }

    function get_user_id() {
        if ((isset($_GET['user_id']) && !is_null($_GET['user_id'])) || 
            (isset($_POST['user_id']) && !is_null($_POST['user_id']))) 
        {
          if (isset($_GET['user_id'])) {
              return $_GET['user_id'];
          }
          else {
              return $_POST['user_id'];
          }
        }
        elseif (isset($_SESSION['user_id'])) {
            return $_SESSION['user_id'];
        }
    }

    function logged_in() {
        return isset($_SESSION['username']);
    }
  
    // For use with LOGGED IN users related pages [profile, logout, edit...]
    function confirm_logged_in() {
        if (!logged_in()) {
            $_SESSION['message'] = 'You must be log in to be able to access restricted sections!';
            header('Location: http://localhost/npower/employee_app/views/users/login.php');
        }
        return;
    }
  
    // For use with GUEST users related pages [login, register...]
    function is_logged_in() {
        if (logged_in()) {
            header('Location: http://localhost/npower/employee_app/views/users/profile.php');
        }
        return;
    }

    function userEmployeeQuery($username=null, $user_id=null) {
        global $conn;

        $sql  = "SELECT u.id AS user_id, u.username, u.email, e.firstname, e.lastname, e.salary, e.dob, e.date_joined, e.qualification_id, q.title As emq_title";
        $sql .= " FROM users As u";
        $sql .= " LEFT JOIN employees_table AS e ON u.id = e.user_id";
        $sql .= " LEFT JOIN qualification AS q ON q.id = e.qualification_id";
        $sql .= is_null($user_id) 
                  ? " WHERE u.username = '$username'" 
                  : " WHERE u.id = '$user_id'"
                  ;
        $stmt = $conn->query($sql);

        return $stmt;
    }

    function setUserEmployeeSession($username=null, $user_id=null) {

        $stmt = userEmployeeQuery($username, $user_id);

        if($stmt->num_rows > 0) {
          $row = $stmt->fetch_assoc();

          $_SESSION['user_id'] = $row['user_id'];
          $_SESSION['username'] = $row['username'];
          $_SESSION['email'] = $row['email'];
        }
    }

    function setUserSession($username=null, $user_id=null) {
        global $conn;

        $sql  = "SELECT * FROM users";
        $sql .= is_null($user_id) 
                  ? " WHERE username = '$username'" 
                  : " WHERE id = '$user_id'"
                  ;
        $stmt = $conn->query($sql);

        if($stmt->num_rows > 0) {
          $row = $stmt->fetch_assoc();

          $_SESSION['user_id'] = $row['id'];
          $_SESSION['username'] = $row['username'];
          $_SESSION['email'] = $row['email'];
          // dd($_SESSION);
        }
    }

    function executeUserLogin(array $row, String $password) {
        // dd($row);

        if ($row['password'] == md5($password)) {
            // Retrieve User Details
            $user_id = $row['id'];
            $username = $row['username'];

            setUserSession($username, $user_id);
        }
        else {
            $_SESSION['message'] = 'Your email or password is incorrect, check and try again.';
            header( 'Location: login.php' );
        }

        return;
    }

    function log_user_in() {
        global $conn;

        if (isset($_POST['btn_login'])) {
          if (!empty($_POST['email']) && !empty($_POST['password'])) {
            // Retrieve User Details
            $email = $_POST['email'];
            $password = $_POST['password'];

            $sql  = "SELECT * FROM users WHERE email = '$email'";
            $stmt = $conn->query($sql);

            if($stmt->num_rows > 0) {
              $row = $stmt->fetch_assoc();

              executeUserLogin($row, $password);
            }

            $_SESSION['message'] = 'You have logged in successfully';
            header( 'Location: profile.php?user_id='. $_SESSION['user_id']);
          }
        }
    }

    function log_user_out() {
        if (logged_in()) {

            // 1. Get all the session variables
            $_SESSION = array();

            // 2. Destroy the session cookie
            if(isset($_COOKIE[session_name()])) {
                setcookie(session_name(), '', time()-42000, '/');
            }

            // 3. Destroy the session
            session_destroy();

            // 4. redirect to Welcome/Home page.
            header('Location: http://localhost/npower/employee_app/');
        }
    }
?>