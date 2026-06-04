<?php
session_start();
require "db_connect.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $roll = $_POST['roll_no'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM students 
            WHERE roll_no='$roll' 
            AND password='$password'";

    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) === 1) {

        $row = mysqli_fetch_assoc($result);

        // ✅ ADD THESE LINES
        $_SESSION['user'] = $row['roll_no'];
        $_SESSION['email'] = $row['student_email']; // ⚠️ IMPORTANT
        $_SESSION['name'] = $row['student_name'];

        header("Location: user/my_events.php"); // go directly here
        exit();

    } else {
        echo "Invalid login details";
    }
}
?>