<?php
session_start();
include 'incloud/bd-db-sa-ee-dd.php';


// اتصال به پایگاه داده
$conn = new mysqli('localhost', $database_username, $database_password, $database_name);

// بررسی اتصال
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// اگر فرم ارسال شده است
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // جستجو در جدول کاربران بر اساس نام کاربری و کلمه عبور
    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($query);

    // اگر یک ردیف بازگشت داده شده است، کاربر وجود دارد
    if ($result->num_rows == 1) {
        // کاربر معتبر است. آغاز نشست
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        header('Location: dashboard.php');
        exit;
    } else {
        // اگر کاربری با این مشخصات یافت نشد، پیام خطا نشان داده می‌شود
        echo "نام کاربری یا کلمه عبور اشتباه است.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap');

        @font-face {
            font-family: vazir;
            src: url('fonts/vazir-font/vazir-font-v16.1.0/Vazir.eot');
            src: url('fonts/vazir-font/vazir-font-v16.1.0/Vazir.eot?#iefix') format('embedded-opentype'),
                url('fonts/vazir-font/vazir-font-v16.1.0/Vazir.woff') format('woff'),
                url('fonts/vazir-font/vazir-font-v16.1.0/Vazir.ttf') format('truetype');
            font-weight: normal;
        }

        @font-face {
            font-family: vazir;
            src: url('fonts/vazir-font/vazir-font-v16.1.0/Vazir-Bold.eot');
            src: url('fonts/vazir-font/vazir-font-v16.1.0/Vazir-Bold.eot?#iefix') format('embedded-opentype'),
                url('fonts/vazir-font/vazir-font-v16.1.0/Vazir-Bold.woff') format('woff'),
                url('fonts/vazir-font/vazir-font-v16.1.0/Vazir-Bold.ttf') format('truetype');
            font-weight: bold;
        }

        @font-face {
            font-family: vazir;
            src: url('fonts/vazir-font/vazir-font-v16.1.0/Vazir-Light.eot');
            src: url('fonts/vazir-font/vazir-font-v16.1.0/Vazir-Light.eot?#iefix') format('embedded-opentype'),
                url('fonts/vazir-font/vazir-font-v16.1.0/Vazir-Light.woff') format('woff'),
                url('fonts/vazir-font/vazir-font-v16.1.0/Vazir-Light.ttf') format('truetype');
            font-weight: 300;
        }

        html {
            font-family: 'Quicksand', vazir;
            text-align: right;
        }

        body {
            direction: rtl;
            font-family: 'Quicksand', vazir;

            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            justify-content: right;
            align-items: right;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="password"] {
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <h2>ورود به سیستم</h2>
    <form action="" method="post">
        <div>
            <label for="username">نام کاربری:</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div>
            <label for="password">کلمه عبور:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit">ورود</button>
    </form>
</body>

</html>