<?php
    require_once('config.php');

    $uname = '';
    $password = '';
    $email = '';

    $username = $_POST['uname'];
    $email = $_POST['email'];

    if (isset($_POST['submit_btn'])) {
        $sql = "SELECT * FROM users";
        $sql .= " WHERE username = '$username'";
        $sql .= " OR email = '$email'";
        $stmt = $conn->query($sql);
          // echo "<pre>";
          // print_r($stmt->num_rows);
          // echo "</pre>";
          // die();

        if($stmt->num_rows > 0) {
            $_SESSION['message'] = 'Username or Email is taken!';

            header('Location: ../views/users/register.php');
            return;
        }
        else {
            $sql = "INSERT INTO users(username, email, password) VALUES (?, ?, ?)";
            
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('sss', $un, $em, $ps);
            
            $un = $_POST['uname'];
            $ps = md5($_POST['password']);
            $em = $_POST['email'];
            $stmt->execute();
            
            if ($stmt) {
                $_SESSION['message'] = 'Your user registration was successful!';

                setUserSession($_POST['uname']);
                $newUserId = $_SESSION['user_id'] ?: mysqli_insert_id($conn);

                header('Location: ../views/users/profile.php?user_id='. $newUserId);
                return;
            }
        }
    }
?>

