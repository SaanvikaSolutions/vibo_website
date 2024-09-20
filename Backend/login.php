<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../Images/Logo/saanvika logo.png" type="image/icon type">
    <title>Login</title>
    <style>
        *{
            margin: 0px;
            padding: 0px;
            box-sizing: border-box;
        }
        body{
            min-height: 100vh;
            font-size: 16px;

            background: radial-gradient(circle, rgba(63,108,251,1) 0%, rgba(6,65,255,1) 100%);
        }
        .login-card{
            margin: auto;
            width: 300px;
            height: 60%;

            position: absolute;
            top: 50%;
            left: 50%;

            transform: translate(-50%,-50%);

            background-color: rgba(255, 255, 255, 0.7);
            border-radius: 20px;
            padding: 10px;
        }
        .login-card .login{
            text-align: center;
            padding: 20px;
            
            font-weight: 800;
            font-size: 2rem;
            
        }
        .login-card form div{
            margin: 20px 0px ;
        }
        .login-card form div label{
            font-weight: 500;
        }
        .login-card form label hr {
            /* border: none; */
            border-color: black;
            height: 0.5px;
        }
        .login-card form label i{
            padding: 10px 0px;
        }
        .login-card form label input[type="text"],.login-card form label input[type="password"]{
            border: none;
            padding: 10px;
            outline: none;
            color: black;

            background-color: inherit;
            border-radius: 10px;
        }
        .login-card form input[type="submit"]{
            font-size: 1rem;
            font-weight: 500;
            width: 100%;
            border-radius: 20px;
            border: none;

            background: radial-gradient(circle, rgba(63,108,251,1) 0%, rgba(6,65,255,1) 100%);
            color: white;
            
            margin: 10px auto;
            padding: 5px;

        }
        .text-warning{
            color: red;
        }

        @media only screen and (max-width: 400px) {
            .login-card{
                width: 95%;
                height: auto;
            }


        }

    </style>
</head>
<body>

<?php
include("./connections/dbconnect.php");

session_start();

// $uname = $pass  = '';

// Define variables to store validation error messages
$errors = array('unameError' => '','passError' => '','combineError' => '');

if($_SERVER["REQUEST_METHOD"] === "POST"){

    if(empty($_POST['username'])){
        $errors['unameError'] = "Username is Empty";
    }
    if(empty($_POST['passwd'])){
        $errors['passError'] = "Password  is Empty";
    }

    $uname = mysqli_real_escape_string($con, $_POST['username']);
    $pass = mysqli_real_escape_string($con, $_POST['passwd']);

    //select the username and password and id
    $SelUserQ = "SELECT * FROM user WHERE Username = '$uname'";
    $SelUserRes = mysqli_query($con,$SelUserQ);

    $numberofrows = mysqli_num_rows($SelUserRes);
    if($numberofrows == 1){
        $row = mysqli_fetch_assoc($SelUserRes);

        if($pass == $row['Password']){
            $_SESSION['username'] = $row['Username'];
            $_SESSION['id'] = $row['UID'];
            $_SESSION['role'] = $row['Role'];
            $_SESSION['Profile'] = strtoupper(substr($_SESSION['username'],0,1));

            header('Location: Expences.php');
            exit();
        }else{
            $errors['combineError'] = "Incorrect Username Or Password";
        }
    }else{
        $errors['combineError'] = "Incorrect Username Or Password";
    }
}
?>

<div class="login-card">
    <form action="" method="post">
        <h1 class="login">Login</h1>
        <small class="text-warning"><?php echo $errors['combineError']; ?></small>
        <div>
            <label for="username">
                Username:
                <br>
                <i class="fa-solid fa-house-user"></i>
                <input type="text" name="username" id="username" placeholder="Enter your username" required>
                <hr>
                <small class="text-warning"><?php echo $errors['unameError']; ?></small>
            </label>
        </div>
        <div>
            <label for="passwd">
                Password:
                <br>
                <i class="fa-solid fa-lock"></i>
                <input type="password" name="passwd" id="passwd" placeholder="Password" required>
                <hr>
                <small class="text-warning"><?php echo $errors['passError']; ?></small>
            </label>
        </div>

        <div>
            <input type="submit" value="Login">
        </div>
    </form>
</div>


<script src="https://kit.fontawesome.com/b19824e628.js" crossorigin="anonymous"></script>
    
</body>
</html>