<?php 
session_start();

// Define the ID of the record to delete
$userIdToDelete = $_GET['id'];

// Read the existing JSON data from the file
$userFile = 'Data/users.json';
$existingData = json_decode(file_get_contents($userFile), true);

// Loop through the existing data to find and remove the record
foreach ($existingData as $key => $record) {
    if ($record["id"] == $userIdToDelete) {
        unset($existingData[$key]); // Remove the record
        break; // Exit the loop once the record is found
    }
}

// Re-index the array to ensure the IDs are in consecutive order
$existingData = array_values($existingData);

// Save the updated data back to the JSON file
file_put_contents($userFile, json_encode($existingData, JSON_PRETTY_PRINT));

$_SESSION['success'] = "User deleted successfully";
// If matching found redirect to login page
header("Location: user_list.php");
exit();
?>
