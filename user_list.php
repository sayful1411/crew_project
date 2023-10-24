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

    .table{
        margin-bottom: 0 !important;
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
        <div class="col-md-12">
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
            <h2>User Lists</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                  <?php 
                    $userData = json_decode(file_get_contents("Data/users.json"), true);
                    foreach($userData as $user){
                  ?>
                    <tr>
                        <td><?php echo $user['username'];?></td>
                        <td><?php echo $user['email'];?></td>
                        <td><?php echo $user['role'];?></td>
                        <td>
                            <a href="edit_user.php?id=<?php echo $user['id'];?>">
                            <button class="btn btn-primary">Edit</button>
                            </a>
                            <a href="delete_user.php?id=<?php echo $user['id'];?>" onclick="return confirm('Are you sure you want to delete this user?');">
                            <button class="btn btn-danger">Delete</button>
                            </a>
                        </td>
                    </tr>
                  <?php } ?>
                  <?php if(empty($userData)){?>
                    <tr>
                      <td colspan="4" class="text-center">No Data Found</td>
                    </tr>
                  <?php } ?>
                </tbody>
            </table>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>

</body>
</html>
