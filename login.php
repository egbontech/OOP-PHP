<?php
include_once "init.php";

if(count($_POST) > 0)
{
    $errors = User::action()->login($_POST);
    if(!is_array($errors) == true){

        header("Location: index.php");
        die();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OOP Login page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
    <form method="POST">
    <h2>Login</h2>
    <div class="error">
    <?php
    if(isset($errors) && is_array($errors) > 0)
    {
        foreach ($errors as $error)
        {
           echo $error .'<br>';
        }
    }
    ?>
    </div>
   
  
        <input type="text"name="email"placeholder="email"value="<?= isset($_POST['email']) ? $_POST['email'] : '' ?>"><br><br>
        <input type="text"name="password"placeholder="password"value="<?= isset($_POST['password']) ? $_POST['password'] : '' ?>"><br><br>
      
        <button type="submit"name="register"style="cursor:pointer">login</button>
    </form>    
</body>
</html>