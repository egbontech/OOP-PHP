<?php
include_once "init.php";

if(count($_POST) > 0)
{
    $errors = User::action()->create($_POST);
    if(!is_array($errors) == true){

        header("Location: login.php");
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
    <title>OOP Register page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
    <form action=""method="post">
    <h2>Signup</h2>
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
   
        <input type="text" name = "name"placeholder="name"value="<?= isset($_POST['name']) ? $_POST['name'] : '' ?>"><br><br>
        <input type="text"name="email"placeholder="email"value="<?= isset($_POST['email']) ? $_POST['email'] : '' ?>"><br><br>
        <input type="text"name="password"placeholder="password"value="<?= isset($_POST['password']) ? $_POST['password'] : '' ?>"><br><br>
        <select name="gender" id=""><br><br>
            <option value=""><?= isset($_POST['gender']) ? $_POST['gender'] : '--Select Gender--' ?></option>
            <option value="male">Male</option>
            <option value="female">Female</option>
        </select><br><br>
        <button type="submit"name="register"style="cursor:pointer">submit</button>
    </form>    
</body>
</html>