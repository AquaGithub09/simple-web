<?php
session_start();

$email_address = $_POST['email_address'];
$password = $_POST['password'];

// Example user data
$users = [
    ['email' => 'admin@example.com', 'password' => 'adminpass', 'user_type' => 'admin'],
    ['email' => 'user@example.com', 'password' => 'userpass', 'user_type' => 'user']
];

$authenticated = false;

foreach ($users as $user) {
    if ($user['email'] == $email_address && $user['password'] == $password) {
        $_SESSION['email_address'] = $email_address;
        $_SESSION['user_type'] = $user['user_type'];
        $authenticated = true;

        if ($user['user_type'] == 'admin') {
            header('location: dashboardadmin.php');
            exit();
        } elseif ($user['user_type'] == 'user') {
            header('location: dashboarduser.php');
            exit();
        }
    }
}

if (!$authenticated) {
    // If login fails, redirect back to login.html with an error message
    header('location: login.php');
    exit();
}
?>
