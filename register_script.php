<?php
session_start();

// check if method not match
if($_SERVER['REQUEST_METHOD'] !== 'POST'){
    echo "Method not allowed";
    return;
}

// get input data
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

if ( empty( $username ) || empty( $email ) || empty( $password ) ) {
    $_SESSION['error'] = "Please fill  all the fields.";
    header("Location: register.php");
    exit();
}

// check that the password has a minimum length of at least 6 characters
if(strlen($password) < 6){
    $_SESSION['error'] = "Password must be grater than 6 character";
    header("Location: register.php");
    exit();
}

// Read the existing JSON data from the file
$userFile = 'Data/users.json';

if (file_exists($userFile)) {
    $existingData = json_decode(file_get_contents($userFile), true);
} else {
    // Initialize an empty array if the JSON file doesn't exist
    $existingData = [];
}

// Check if the email already exists in the user data
foreach ($existingData as $user) {
    if ($user['email'] === $email) {
        $_SESSION['error'] = "Email already exists. Please use a different email.";
        header("Location: register.php");
        exit(); // Terminate further processing
    }
}

// Hash the password using bcrypt and a random salt
$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

// Define the new record to be added
$newRecord = [
    "id" => count($existingData) + 1, // Automatically increment the id
    "username" => $username,
    "email" => $email,
    "password" => $hashedPassword,
    "role" => "user"
];

// Append the new record to the existing data
$existingData[] = $newRecord;

// Write the updated data back to the JSON file
file_put_contents($userFile, json_encode($existingData, JSON_PRETTY_PRINT));

// generate session message
$_SESSION['success'] = "Registration was successfull. Now you can login";

// redirect to login page
header("Location: login.php");
?>