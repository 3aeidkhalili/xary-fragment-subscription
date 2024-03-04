<?php
// اطلاعات ورود به پایگاه داده
$database_username = 'یوزر دیتابیس';
$database_password = 'رمز دیتابیس';
$database_name = 'نام دیتابیس';

// اتصال به پایگاه داده
$conn = new mysqli('localhost', $database_username, $database_password, $database_name);

// بررسی اتصال
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}