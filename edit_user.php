
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

// Load user data from JSON files
$userData = json_decode(file_get_contents("Data/users.json"), true);

$userId = $_GET['id']; // Get the user ID from the URL
$userToEdit = null;

// Find the user to edit based on the ID
foreach ($userData as $user) {
    if ($user['id'] == $userId) {
        $userToEdit = $user;
        break;
    }
}

if (!$userToEdit) {
    // Handle the case where the user ID is not found
    $_SESSION["error"] = "User not found.";
    header("Location: user_list.php");
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
  <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
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
        <li><a href="dashboard.php">Dashboard</a></li>
        <li class="active"><a href="user_list.php">Role Management</a></li>
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
        <li><a href="dashboard.php">Dashboard</a></li>
        <li class="active"><a href="user_list.php">Role Management</a></li>
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
    
    <div class="col-sm-9">
      <div class="row">
        <div class="col-md-6 mx-auto">
          <div class="well">
          <?php 
                  if(isset($_SESSION['error'])){
              ?>
              <div class="alert alert-danger" role="alert">
                  <?php 
                      echo $_SESSION['error'];
                      unset($_SESSION['error']);
                  ?>
              </div>
              <?php } ?>
              <?php 
                  if(isset($_SESSION['success'])){
              ?>
              <div class="alert alert-success" role="alert">
                  <?php 
                      echo $_SESSION['success'];
                      unset($_SESSION['success']);
                  ?>
              </div>
              <?php } ?>
                <form method="post" action="update_user.php">
                    <input type="hidden" name="id" value="<?= $userToEdit['id']; ?>">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" name="username" id="username" value="<?= $userToEdit['username']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email" value="<?= $userToEdit['email']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="New Password">
                    </div>
                    <div class="form-group">
                      <label for="role">Role</label>
                      <select id="role" name="role" class="selectpicker form-control">
                          <option value="admin" <?= ($userToEdit['role'] === 'admin') ? 'selected' : ''; ?>>Admin</option>
                          <option value="manager" <?= ($userToEdit['role'] === 'manager') ? 'selected' : ''; ?>>Manager</option>
                          <option value="user" <?= ($userToEdit['role'] === 'user') ? 'selected' : ''; ?>>User</option>
                      </select>
                    </div>
                    <button class="btn btn-primary" type="submit">Save</button>
                </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

</body>
</html>
