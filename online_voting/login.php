<?php
session_start();

if (isset($_POST['submit'])) {

    $Email = trim($_POST['email']);

    // 1️⃣ Valid email format check
    if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>
            alert('Invalid Email format');
            window.location.href='index.php';
        </script>";
        exit();
    }

    // 2️⃣ Only Gmail allow
    if (!preg_match("/@gmail\.com$/", $Email)) {
        echo "<script>
            alert('Only Gmail allowed');
            window.location.href='index.php';
        </script>";
        exit();
    }

    // ✅ Login success for anyone
    $_SESSION['email'] = $Email;
header("Location: register.php");
    exit();
}
?>