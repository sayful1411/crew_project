<?php
session_start();

$userId = $_POST['id']; // Get the user ID from the form
$newUsername = $_POST['username'];
$newEmail = $_POST['email'];
$newPassword = $_POST['password']; // Check if a new password is provided
$newRole = $_POST['role'];

// Load user data from JSON files
$userData = json_decode(file_get_contents("Data/users.json"), true);

// Check if the email already exists in the user data
foreach ($userData as $user) {
    if ($user['email'] === $newEmail && $user['id'] != $userId) {
        $_SESSION['error'] = "Email already exists. Please use a different email.";
        header("Location: edit_user.php?id=$userId");
        exit(); 
    }
}

// Find the user to update based on the ID
foreach ($userData as &$user) {
    if ($user['id'] == $userId) {
        // Update the user's data
        $user['username'] = $newUsername;
        $user['email'] = $newEmail;
        if (!empty($newPassword)) {
            // Update the password only if a new one is provided
            // Hash the new password and store it
            // check that the password has a minimum length of at least 6 characters
            if(strlen($newPassword) < 6){
                $_SESSION['error'] = "Password must be grater than 6 character";
                header("Location: edit_user.php?id=$userId");
                exit();
            }
            $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
            $user['password'] = $hashedPassword;
        }
        $user['role'] = $newRole;
        // Update other fields as needed
        break;
    }
}

// Save the updated data back to the JSON file
file_put_contents("Data/users.json", json_encode($userData, JSON_PRETTY_PRINT));

// set a session message
$_SESSION['success'] = "User Updated Successfully";
// Redirect back to the user list page
header("Location: user_list.php");
