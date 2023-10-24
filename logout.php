<?php 
session_start();

session_destroy();

// if(isset($_COOKIE['username']) && isset($_COOKIE['password'])){
//     setcookie ("username",$_COOKIE['username'],time()-1);
//     setcookie ("password",$_COOKIE['password'],time()-1);
// }

header('Location: login.php');