<?php 
session_start();

// check if method not match
if($_SERVER['REQUEST_METHOD'] !== "POST"){
    echo "Method not allowed";
}

// get input data
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$role = $_POST['role'];

// check that the password has a minimum length of at least 6 characters
if(strlen($password) < 6){
    $_SESSION['error'] = "Password must be grater than 6 character";
    header("Location: add_user.php");
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
        header("Location: add_user.php");
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
    "role" => $role
];

// Append the new record to the existing data
$existingData[] = $newRecord;

// Write the updated data back to the JSON file
file_put_contents($userFile, json_encode($existingData, JSON_PRETTY_PRINT));

// generate session message
$_SESSION['success'] = "User added successfully";

// redirect to login page
header("Location: add_user.php");