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
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ورود به سیستم</title>
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

        body {
            font-family: 'Quicksand', vazir;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            direction: rtl;
        }

        .container {
            background-color: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
            font-weight: 700;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        .form-group {
            margin-bottom: 20px;
            text-align: right;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
            font-weight: 500;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            font-family: 'Quicksand', vazir;
            transition: border-color 0.3s ease;
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
            border-color: #667eea;
            outline: none;
        }

        button[type="submit"] {
            background-color: #667eea;
            color: #fff;
            border: none;
            padding: 12px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            font-family: 'Quicksand', vazir;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: #5a6fd1;
        }

        .error-message {
            color: #ff4d4d;
            margin-top: 10px;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>ورود به سیستم</h2>
        <form action="" method="post">
            <div class="form-group">
                <label for="username">نام کاربری:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">کلمه عبور:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">ورود</button>
            <?php if (isset($error_message)): ?>
                <div class="error-message"><?php echo $error_message; ?></div>
            <?php endif; ?>
        </form>
    </div>
</body>

</html>
