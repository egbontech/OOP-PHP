<?php
include_once "init.php";

$auth = User::action()->auth();
if(!$auth)
{
    header("Location: login.php");
    die();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
</head>
<body>
    <center>Home Page</center><br><br>
    <?php print_r($_SESSION) ?>
   
    <center>
    <a href="logout.php">Logout</a>
    </center>
  
</body>
</html>






