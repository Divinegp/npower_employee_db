<?php
    require_once('config.php');

    $user_id = get_user_id();//$_POST['user_id'];
    $fname = '';
    $lname = '';
    $salary = '';
    $dob = '';
    $qual = '';

    if (isset($_POST['submit_btn'])) {
        $sql = "INSERT INTO employees_table(firstname, lastname, salary, dob, date_joined, user_id, qualification_id) VALUES (?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sssssii', $fn, $ln, $sa, $db, $dj, $uid, $qid);
        
        $fn = $_POST['fname'];
        $ln = $_POST['lname'];
        $sa = $_POST['salary'];
        $db = $_POST['dob'];
        $dj = $_POST['djoined'];
        $uid = $_POST['user_id'];
        $qid = $_POST['qual_id'];
        $stmt->execute();
        
        if ($stmt) {
            $_SESSION['message'] = 'Employee record update was successful!';
            header('Location: ../dashboard.php');
            return;
        }
    }
?>

