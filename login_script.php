<?php 
session_start();

// check if method not match
if($_SERVER['REQUEST_METHOD'] !== "POST"){
    echo "Method not allowed";
}

// Get user-provided email and password
$email = $_POST['email'];
$password = $_POST['password'];

// Load user and admin data from JSON files
$userData = json_decode(file_get_contents("Data/users.json"), true);
$adminData = json_decode(file_get_contents("Data/admins.json"), true);

 // Function to find a user or admin by email and password
 function findUser($data, $email, $password) {
    foreach ($data as $user) {
        if ($user['email'] === $email && password_verify($password, $user['password'])) {
            if(!empty($_POST["remember"])) {
                setcookie ("username",$user['email'],time()+ 3600);
                setcookie ("password",$password,time()+ 3600);
            }
            return $user;
        }
    }
    return null;
}

// Check if the provided credentials match a user
$user = findUser($userData, $email, $password);

if ($user) {
    if ($user['role'] === 'user') {
        // Redirect to user page
        $_SESSION['username'] = $user['username'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['role'] = $user['role'];
        header("Location: user_page.php");
        exit();
    }
    if ($user['role'] === 'manager') {
        // Redirect to user page
        $_SESSION['username'] = $user['username'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['role'] = $user['role'];
        header("Location: manager_page.php");
        exit();
    }
}

 // Function to find a user or admin by email and password
 function findAdmin($data, $email, $password) {
    foreach ($data as $admin) {
        if ($admin['email'] === $email && $admin['password'] === $password) {
            return $admin;
        }
    }
    return null;
}

// Check if the provided credentials match an admin
$admin = findAdmin($adminData, $email, $password);

if ($admin) {
    if ($admin['role'] === 'admin') {
        // Redirect to admin dashboard
        $_SESSION['username'] = $admin['username'];
        $_SESSION['email'] = $admin['email'];
        $_SESSION['role'] = $admin['role'];
        header("Location: dashboard.php");
        exit();
    }
}

// If no matching user or admin was found, display an error message
$_SESSION['error'] = "Invalid email or password.";
// If matching found redirect to login page
header("Location: login.php");
exit();

?>