<?php 
session_start();

if(!isset($_SESSION["username"])){
    header("Location: login.php");
}

if($_SESSION['role'] == 'user'){
  header('Location: user_page.php');
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
  <title>Admin Dashboard</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
    /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
    .row.content {height: 550px}
    
    /* Set gray background color and 100% height */
    .sidenav {
      background-color: #f1f1f1;
      height: 100%;
    }

    a.logout{
      text-decoration: none;
      color: #fff;
    }
        
    /* On small screens, set height to 'auto' for the grid */
    @media screen and (max-width: 767px) {
      .row.content {height: auto;} 
    }
  </style>
</head>
<body>

<nav class="navbar navbar-inverse visible-xs">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">Logo</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="dashboard.php">Dashboard</a></li>
        <li><a href="user_list.php">Role Management</a></li>
        <li><a href="add_user.php">Add User</a></li>
      </ul>
      <br>
      <br>
      <br>
      <br>
      <div style="border-top: 1px solid #3f3f3f;">
      <ul class="nav nav-pills nav-stacked">
        <li><h3><?php echo $_SESSION['email'];?></h3></li>
        <li><h4><?php echo $_SESSION['role'];?></h4></li>
        <li><button class="btn btn-sm btn-danger"><a class="logout" href="logout.php">Logout</a></button></li>
      </ul>
      </div>
    </div>
  </div>
</nav>

<div class="container-fluid">
  <div class="row content">
    <div class="col-sm-3 sidenav hidden-xs">
      <h2>Logo</h2>
      <ul class="nav nav-pills nav-stacked">
        <li class="active"><a href="dashboard.php">Dashboard</a></li>
        <li><a href="user_list.php">Role Management</a></li>
        <li><a href="add_user.php">Add User</a></li>
      </ul>
      <br>
      <br>
      <br>
      <br>
      <div style="border-top: 1px solid #3f3f3f;">
      <ul class="nav nav-pills nav-stacked">
        <li><h3><?php echo $_SESSION['email'];?></h3></li>
        <li><h4><?php echo $_SESSION['role'];?></h4></li>
        <li><button class="btn btn-sm btn-danger"><a class="logout" href="logout.php">Logout</a></button></li>
      </ul>
      </div>
    </div>
    <br>
    <?php 
      // Load user and admin data from JSON files
      $userData = json_decode(file_get_contents("Data/users.json"), true);
      $adminData = json_decode(file_get_contents("Data/admins.json"), true);
      $adminCount = 0;
      $managerCount = 0;
      $userCount = 0;

      foreach($userData as $user){
        if($user["role"] == "admin"){
          $adminCount++;
        }
        if($user["role"] == "manager"){
          $managerCount++;
        }
        if($user["role"] == "user"){
          $userCount++;
        }
      }

      $admins = count($adminData);
    ?>
    <div class="col-sm-9">
      <div class="well">
        <h4>Dashboard</h4>
        <p>Welcome back, <?php echo $_SESSION['username']; ?></p>
      </div>
      <div class="row">
        <div class="col-sm-3">
          <div class="well">
            <h4>Users</h4>
            <p><?php echo $userCount; ?></p> 
          </div>
        </div>
        <div class="col-sm-3">
          <div class="well">
            <h4>Admin</h4>
            <p><?php echo $admins + $adminCount; ?></p> 
          </div>
        </div>
        <div class="col-sm-3">
          <div class="well">
            <h4>Manager</h4>
            <p><?php echo $managerCount; ?></p> 
          </div>
        </div>
        <div class="col-sm-3">
          <div class="well">
            <h4>Date & Time</h4>
            <p>
              <?php 
              $tz = 'Asia/Dhaka';   
              date_default_timezone_set($tz);
              echo date("d-M-Y | H:i A");
              ?>
            </p> 
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

</body>
</html>
