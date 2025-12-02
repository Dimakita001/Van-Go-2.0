<?php
session_start();

// Define your valid code
$valid_code = "1z2x3y";

// Check if the submitted code matches
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $entered_code = $_POST['code'];

    if ($entered_code === $valid_code) {
        $_SESSION['authenticated'] = true;
        header('Location: AD00.php'); // Redirect to the hidden page
        exit();
    } else {
        header('Location: index.php');
    }
}
?>
