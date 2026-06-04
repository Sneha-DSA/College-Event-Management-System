<?php
session_start();
require "db_connect.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$res = mysqli_query($conn, "SELECT * FROM users WHERE id='$user_id'");
$user = mysqli_fetch_assoc($res);

if (isset($_POST['update'])) {

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    $update = mysqli_query($conn,
    "UPDATE users
    SET full_name='$name',
    email='$email'
    WHERE id='$user_id'");

    if($update){

        $_SESSION['user_name'] = $name;

        echo "
        <script>
            alert('🎉 Profile Updated Successfully');
            window.location.href='profile.php';
        </script>
        ";

    } else {

        echo "
        <script>
            alert('Something went wrong');
        </script>
        ";

    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
    content="width=device-width, initial-scale=1.0">

    <title>Update Profile</title>

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
            background:#f4f7fb;
            min-height:100vh;
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
            color:white;
            text-decoration:none;
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

        /* PAGE */

        .page{
            flex:1;
            display:flex;
            justify-content:center;
            align-items:center;
            padding:50px 20px;
        }

        /* PROFILE CARD */

        .profile-card{
            width:100%;
            max-width:500px;
            background:white;
            border-radius:25px;
            padding:40px;
            box-shadow:0 10px 30px rgba(0,0,0,0.08);
            position:relative;
            overflow:hidden;
        }

        .profile-card::before{
            content:'';
            position:absolute;
            top:0;
            left:0;
            width:100%;
            height:140px;
            background:linear-gradient(135deg,#081229,#163c78);
        }

        .profile-top{
            position:relative;
            text-align:center;
            margin-bottom:40px;
        }

        .profile-icon{
            width:110px;
            height:110px;
            border-radius:50%;
            background:white;
            margin:auto;
            display:flex;
            justify-content:center;
            align-items:center;
            font-size:45px;
            color:#4f8cff;
            box-shadow:0 5px 20px rgba(0,0,0,0.1);
        }

        .profile-top h2{
            margin-top:18px;
            font-size:28px;
            color:#111827;
        }

        .profile-top p{
            color:#6b7280;
            margin-top:5px;
        }

        /* FORM */

        .form-group{
            margin-bottom:25px;
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
            transition:0.3s;
            outline:none;
        }

        .input-box input:focus{
            border-color:#4f8cff;
        }

        /* BUTTON */

        .update-btn{
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

        .update-btn:hover{
            transform:translateY(-3px);
        }

        /* EXTRA BUTTONS */

        .extra-buttons{
            margin-top:25px;
            display:flex;
            gap:15px;
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

        .password-btn{
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

            .profile-card{
                padding:30px 25px;
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

    <!-- PAGE -->

    <div class="page">

        <div class="profile-card">

            <!-- TOP -->

            <div class="profile-top">

                <div class="profile-icon">
                    <i class="fa-solid fa-user"></i>
                </div>

                <h2>
                    <?= htmlspecialchars($user['full_name']) ?>
                </h2>

                <p>
                    Manage your profile information
                </p>

            </div>

            <!-- FORM -->

            <form method="POST">

                <!-- NAME -->

                <div class="form-group">

                    <label>Full Name</label>

                    <div class="input-box">

                        <i class="fa-solid fa-user"></i>

                        <input type="text"
                        name="name"
                        value="<?= htmlspecialchars($user['full_name']) ?>"
                        required>

                    </div>

                </div>

                <!-- EMAIL -->

                <div class="form-group">

                    <label>Email Address</label>

                    <div class="input-box">

                        <i class="fa-solid fa-envelope"></i>

                        <input type="email"
                        name="email"
                        value="<?= htmlspecialchars($user['email']) ?>"
                        required>

                    </div>

                </div>

                <!-- BUTTON -->

                <button type="submit"
                name="update"
                class="update-btn">

                    Update Profile

                </button>

            </form>

            <!-- EXTRA BUTTONS -->

            <div class="extra-buttons">

                <a href="user/dashboard.php"
                class="dashboard-btn">

                    ← Dashboard

                </a>

                <a href="change_password.php"
                class="password-btn">

                    Change Password

                </a>

            </div>

        </div>

    </div>

    <!-- FOOTER -->

    <footer>
        © 2026 College Event Management System
    </footer>

</body>

</html>