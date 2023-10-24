<?php 
session_start();

if(!isset($_SESSION["username"])){
    header("Location: login.php");
    exit();
}

if($_SESSION['role'] == 'admin'){
  header('Location: dashboard.php');
  exit();
}

if($_SESSION['role'] == 'manager'){
  header('Location: manager_page.php');
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UserPage</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="py-3 mb-3 text-white text-center bg-primary">
            <h1>User Page</h1>
        </div>
        <div class="mb-3">
            <ul class="list-group">
                <li class="list-group-item"><h2>Welcome, <?php echo $_SESSION['username'];?></h2></li>
                <li class="list-group-item"><h3>Your Email is: <span class="bg-warning text-white p-2"><?php echo $_SESSION['email']; ?></span></h3></li>
                <li class="list-group-item"><h5>Your Role is: <span class="bg-primary text-white p-2"><?php echo $_SESSION['role']; ?></span></h5></li>
            </ul>
        </div>
        
        
        <a href="logout.php">
            <button class="btn btn-danger">
                logout
            </button>
        </a>
    </div>
</body>
</html>