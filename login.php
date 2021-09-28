<?php
/**
 * Created by PhpStorm.
 * User: shady
 * Date: 12/27/18
 * Time: 8:36 AM
 */

include("SfsApplication.php");
$app = new SfsApplication();
//if the login form is submitted
if (isset($_POST['submit'])) {

// makes sure they filled it in
    if (!$_POST['username']) {
        die('Не введено ім’я користувача.');
    }
    if (!$_POST['pass']) {
        die('Не введено пароль.');
    }

    $users = $app->getUsers();
    if(!$app->verifyUser($_POST['username'])){
        die('Невірний пароль чи ім’я, спробуйте <a href="login.php">знову</a>.');
    }else{
        if ($_POST['pass'] != $app->getUserPassword($_POST['username'])){
            die('Невірний пароль чи ім’я, спробуйте <a href="login.php">знову</a>.');
        }else{
            $app->setCookie();
        }
    }
}
?>

<!-- View Section  -->
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $app->getAppName();?></title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="css/login.css" rel="stylesheet">
</head>

<body>
<div class="login-page">
    <div class="form">
        <a href="index.php"><i class="fa fa-folder-open fa-2x"></i></a><br>
        <h3><?php echo $app->getAppName();?></h3>
        <form class="login-form" action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
            <input type="text" placeholder="Користувач" name="username"/>
            <input type="password" placeholder="Пароль" name="pass"/>
            <button type="submit" name="submit" value="Login">Логін</button>
        </form>
    </div>
</div>

</body>

</html>
