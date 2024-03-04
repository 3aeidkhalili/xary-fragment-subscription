<?php
session_start();

// اگر کاربر لاگ‌اوت کرده است، سشن را حذف کنید
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    // حذف تمام متغیرهای مربوط به کاربر از سشن
    session_unset();

    // از سشن خارج شوید
    session_destroy();
}

// هدایت کاربر به صفحه ورود
header('Location: index.php');
exit;
?>
