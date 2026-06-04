<?php
session_start();
require "db_connect.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if (isset($_POST['change'])) {

    $current = mysqli_real_escape_string($conn, $_POST['current_password']);

    $new = mysqli_real_escape_string($conn, $_POST['new_password']);

    $confirm = mysqli_real_escape_string($conn, $_POST['confirm_password']);

    // GET USER

    $checkUser = mysqli_query($conn,
    "SELECT * FROM users WHERE id='$user_id'");

    $user = mysqli_fetch_assoc($checkUser);

    // CHECK CURRENT PASSWORD

    if ($current != $user['password']) {

        $msg = "❌ Current password is incorrect";
        $type = "error";

    }

    // CHECK MATCH

    elseif ($new != $confirm) {

        $msg = "❌ New passwords do not match";
        $type = "error";

    }

    // PASSWORD LENGTH

    elseif (strlen($new) < 6) {

        $msg = "❌ Password must be at least 6 characters";
        $type = "error";

    }

    else {

        // UPDATE PASSWORD

        $update = mysqli_query($conn,
        "UPDATE users
        SET password='$new'
        WHERE id='$user_id'");

        if ($update) {

            $msg = "🎉 Password changed successfully!";
            $type = "success";

        } else {

            $msg = "❌ Something went wrong";
            $type = "error";

        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
    content="width=device-width, initial-scale=1.0">

    <title>Change Password</title>

    <!-- GOOGLE FONT -->

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
    rel="stylesheet">

    <!-- FONT AWESOME -->

    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Poppins',sans-serif;
        }

        body{
            min-height:100vh;
            background:#f4f7fb;
            display:flex;
            flex-direction:column;
        }

        /* NAVBAR */

        .navbar{
            width:100%;
            background:#081229;
            padding:18px 8%;
            display:flex;
            justify-content:space-between;
            align-items:center;
            position:sticky;
            top:0;
            z-index:1000;
            box-shadow:0 5px 20px rgba(0,0,0,0.15);
        }

        .logo{
            color:white;
            font-size:24px;
            font-weight:700;
        }

        .logo span{
            color:#4f8cff;
        }

        .menu{
            display:flex;
            align-items:center;
            gap:25px;
        }

        .menu a{
            text-decoration:none;
            color:white;
            font-size:15px;
            transition:0.3s;
        }

        .menu a:hover{
            color:#4f8cff;
        }

        .logout-btn{
            background:#ef4444;
            padding:10px 18px;
            border-radius:8px;
        }

        /* MAIN */

        .main-container{
            flex:1;
            display:flex;
            justify-content:center;
            align-items:center;
            padding:50px 20px;
        }

        /* CARD */

        .password-card{
            width:100%;
            max-width:500px;
            background:white;
            border-radius:25px;
            overflow:hidden;
            box-shadow:0 10px 30px rgba(0,0,0,0.08);
        }

        /* TOP */

        .card-top{
            background:linear-gradient(135deg,#081229,#163c78);
            padding:40px;
            color:white;
            text-align:center;
        }

        .card-top .icon{
            width:90px;
            height:90px;
            background:white;
            color:#4f8cff;
            border-radius:50%;
            display:flex;
            justify-content:center;
            align-items:center;
            font-size:38px;
            margin:auto;
            margin-bottom:20px;
        }

        .card-top h2{
            font-size:32px;
            margin-bottom:10px;
        }

        .card-top p{
            color:#dbe4ff;
            line-height:1.6;
        }

        /* FORM */

        .form-section{
            padding:35px;
        }

        .form-group{
            margin-bottom:22px;
        }

        .form-group label{
            display:block;
            margin-bottom:10px;
            font-weight:600;
            color:#374151;
        }

        .input-box{
            position:relative;
        }

        .input-box i{
            position:absolute;
            top:50%;
            left:18px;
            transform:translateY(-50%);
            color:#6b7280;
        }

        .input-box input{
            width:100%;
            padding:15px 15px 15px 50px;
            border:2px solid #e5e7eb;
            border-radius:12px;
            font-size:15px;
            outline:none;
            transition:0.3s;
        }

        .input-box input:focus{
            border-color:#4f8cff;
        }

        /* BUTTON */

        .change-btn{
            width:100%;
            border:none;
            background:linear-gradient(135deg,#4f8cff,#163c78);
            color:white;
            padding:16px;
            border-radius:12px;
            font-size:16px;
            font-weight:600;
            cursor:pointer;
            transition:0.3s;
        }

        .change-btn:hover{
            transform:translateY(-3px);
        }

        /* MESSAGE */

        .message{
            margin-top:20px;
            padding:14px;
            border-radius:10px;
            text-align:center;
            font-weight:600;
        }

        .success{
            background:#dcfce7;
            color:#15803d;
        }

        .error{
            background:#fee2e2;
            color:#dc2626;
        }

        /* EXTRA BUTTONS */

        .extra-buttons{
            display:flex;
            gap:15px;
            margin-top:25px;
        }

        .extra-buttons a{
            flex:1;
            text-align:center;
            text-decoration:none;
            padding:14px;
            border-radius:12px;
            font-weight:600;
            transition:0.3s;
        }

        .dashboard-btn{
            background:#e0e7ff;
            color:#163c78;
        }

        .profile-btn{
            background:#dcfce7;
            color:#15803d;
        }

        .extra-buttons a:hover{
            transform:translateY(-3px);
        }

        /* FOOTER */

        footer{
            background:#081229;
            color:white;
            text-align:center;
            padding:20px;
        }

        /* MOBILE */

        @media(max-width:768px){

            .navbar{
                flex-direction:column;
                gap:15px;
                padding:20px;
            }

            .menu{
                flex-wrap:wrap;
                justify-content:center;
            }

            .card-top{
                padding:30px 20px;
            }

            .card-top h2{
                font-size:26px;
            }

            .form-section{
                padding:25px;
            }

            .extra-buttons{
                flex-direction:column;
            }
        }

    </style>

</head>

<body>

    <!-- NAVBAR -->

    <div class="navbar">

        <div class="logo">
            <div class="logo">🎓 College Event Portal</div>
        </div>

        <div class="menu">

            <a href="user/dashboard.php">Dashboard</a>

            <a href="profile.php">Profile</a>

            <a href="user/my_events.php">My Bookings</a>

            <a href="change_password.php">Password</a>

            <a href="../logout.php" class="logout-btn">
                Logout
            </a>

        </div>

    </div>

    <!-- MAIN -->

    <div class="main-container">

        <div class="password-card">

            <!-- TOP -->

            <div class="card-top">

                <div class="icon">
                    <i class="fa-solid fa-lock"></i>
                </div>

                <h2>Change Password</h2>

                <p>
                    Keep your account secure by updating your password regularly.
                </p>

            </div>

            <!-- FORM -->

            <div class="form-section">

                <form method="POST">

                    <!-- CURRENT -->

                    <div class="form-group">

                        <label>
                            Current Password
                        </label>

                        <div class="input-box">

                            <i class="fa-solid fa-lock"></i>

                            <input type="password"
                            name="current_password"
                            placeholder="Enter current password"
                            required>

                        </div>

                    </div>

                    <!-- NEW -->

                    <div class="form-group">

                        <label>
                            New Password
                        </label>

                        <div class="input-box">

                            <i class="fa-solid fa-key"></i>

                            <input type="password"
                            name="new_password"
                            placeholder="Enter new password"
                            required>

                        </div>

                    </div>

                    <!-- CONFIRM -->

                    <div class="form-group">

                        <label>
                            Confirm Password
                        </label>

                        <div class="input-box">

                            <i class="fa-solid fa-check"></i>

                            <input type="password"
                            name="confirm_password"
                            placeholder="Confirm new password"
                            required>

                        </div>

                    </div>

                    <!-- BUTTON -->

                    <button type="submit"
                    name="change"
                    class="change-btn">

                        Update Password

                    </button>

                </form>

                <!-- MESSAGE -->

                <?php if(isset($msg)) { ?>

                    <div class="message <?= $type ?>">

                        <?= $msg ?>

                    </div>

                <?php } ?>

                <!-- EXTRA BUTTONS -->

                <div class="extra-buttons">

                    <a href="user/dashboard.php"
                    class="dashboard-btn">

                        ← Dashboard

                    </a>

                    <a href="profile.php"
                    class="profile-btn">

                        Profile

                    </a>

                </div>

            </div>

        </div>

    </div>

    <!-- FOOTER -->

    <footer>
        © 2026 College Event Management System
    </footer>

</body>

</html>