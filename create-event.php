<?php
session_start();
if (!isset($_SESSION['student'])) {
    header("Location:Login.php");
    exit();
}
?>


<?php
session_start();
?>

<?php
include "db_connect.php";

if (isset($_POST['event_name'])) {
    $name = $_POST['event_name'];
    $date = $_POST['event_date'];
    $desc = $_POST['description'];

    $query = "INSERT INTO events (event_name, event_date, description)
              VALUES ('$name', '$date', '$desc')";

    mysqli_query($conn, $query);

    echo "<script>alert('Event Created Successfully');</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Event</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(120deg, #667eea, #764ba2);
            min-height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .event-box {
            background: #fff;
            padding: 30px;
            width: 400px;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        label {
            font-weight: bold;
            display: block;
            margin-top: 15px;
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        textarea {
            resize: none;
            height: 80px;
        }

        button {
            width: 100%;
            margin-top: 20px;
            padding: 12px;
            border: none;
            background: #667eea;
            color: white;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background: #5a67d8;
        }

        .back {
            text-align: center;
            margin-top: 15px;
        }

        .back a {
            text-decoration: none;
            color: #667eea;
            font-weight: bold;
        }
    </style>
</head>

<body>

<div class="event-box">
    <h1>Create Event</h1>

    <form method="post">
        <label>Event Name</label>
        <input type="text" name="event_name" required>

        <label>Date</label>
        <input type="date" name="event_date" required>

        <label>Description</label>
        <textarea name="description" required></textarea>

       <a href="event.php/add.php">Create Event</a>


    </form>

    <div class="back">
        <a href="index.php">← Back to Home</a>
    </div>
</div>

</body>
</html>
