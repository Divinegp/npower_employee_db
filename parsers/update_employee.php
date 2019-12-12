<?php
    require_once('config.php');
    
    $user_id = get_user_id();//$_POST['user_id'];//

    if (isset($_POST['btn_update'])) {
        $sql = "SELECT * FROM employees_table";
        $sql .= " WHERE user_id = '$user_id'";
        $stmt = $conn->query($sql);

        if($stmt->num_rows > 0) {
            $sql = "UPDATE employees_table SET firstname = ?, lastname = ?, salary = ?, dob = ?, date_joined = ?, qualification_id = ? WHERE user_id= ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('sssssii', $fn, $ln, $sa, $db, $dj, $qid, $uid);

            $fn = $_POST['fname'];
            $ln = $_POST['lname'];
            $sa = $_POST['salary'];
            $db = $_POST['dob'];
            $dj = $_POST['djoined'];
            $uid = $user_id;
            $qid = $_POST['qual_id'];
            $stmt->execute();

            if ($stmt) {
                // if ($_SESSION['user_id'] == $_POST['user_id']) {
                //     setUserSession($_SESSION['username']);
                //     header('Location: ../views/users/profile.php');
                // }

                $_SESSION['message'] = 'Employee details added successfully!';
                header('Location: ../dashboard.php');
                return;
            }
        }
        else {
            $sql = "INSERT INTO employees_table(firstname, lastname, salary, dob, date_joined, user_id, qualification_id) VALUES (?, ?, ?, ?, ?, ?, ?)";

            $stmt = $conn->prepare($sql);
            $stmt->bind_param('sssssii', $fn, $ln, $sa, $db, $dj, $uid, $qid);
            
            $fn = $_POST['fname'];
            $ln = $_POST['lname'];
            $sa = $_POST['salary'];
            $db = $_POST['dob'];
            $dj = $_POST['djoined'];
            $uid = $user_id;
            $qid = $_POST['qual_id'];
            $stmt->execute();
            
            if ($stmt) {
                $_SESSION['message'] = 'Employee record update was successful!';
                header('Location: ../dashboard.php');
                return;
            }
        }
    }
?>

