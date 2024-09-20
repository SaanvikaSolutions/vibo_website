<?php
session_start(); 
include("./connections/dbconnect.php");
include("./includes/navbar.php");
?>
<?php
// Define variables to store user input
$uname = $pass = $cpass = '';

// Define variables to store validation error messages
$errors = array('username' => '','email' => '', 'password' => '', 'confirm_password' => '');

if($_SERVER["REQUEST_METHOD"] === "POST"){

    $uname = mysqli_real_escape_string($con, $_POST["name"]);
    $email = mysqli_real_escape_string($con, $_POST["email"]);
    $pass = mysqli_real_escape_string($con, $_POST["pass"]);
    $cpass = mysqli_real_escape_string($con, $_POST["cpass"]);
    $role = mysqli_real_escape_string($con, $_POST["role"]);

    //checking the error in username
    if(empty($_POST["name"])){
        $errors['username'] = "Username is required";
    }else{
        //query to select username with same username
        $checkUName = "SELECT Username FROM user WHERE Username = '$uname'";
        $UNameRes = mysqli_query($con,$checkUName); //query executed

        if(mysqli_num_rows($UNameRes) > 0 ){
            $errors['username'] = 'Username already exists';
        }
    }


    //checking the error in Email
    if(empty($_POST["email"])){
        $errors['email'] = "Email is required";
    }else{
        

        //query to select Email with same Email
        $checkEmail = "SELECT Email FROM user WHERE Email = '$email'";
        $EmailRes = mysqli_query($con,$checkEmail); //query executed

        if(mysqli_num_rows($EmailRes) > 0 ){
            $errors['email'] = 'Email already exists';
        }
    }


    //checking the error in password
    if(empty($_POST["pass"])){
        $errors['password'] = "Password is required";
    }else{
        

        if (strlen($pass) < 8) {
            $errors['password'] = 'Password must be at least 8 characters long';
        }
    }

    // Validate confirm password
    if (empty($_POST['cpass'])) {
        $errors['confirm_password'] = 'Please confirm your password';
    } else {
        
        if ($pass !== $cpass) {
            $errors['confirm_password'] = 'Passwords do not match';
        }
    }

    if(empty($errors['username'])  && empty($errors['email']) && empty($errors['password']) && empty($errors['confirm_password'])){

        $reguser = "INSERT INTO `user` (`Username`, `Email`, `Password`, `Role`) VALUES ('$uname', '$email', '$pass', '$role')";
        $ResultUser = mysqli_query($con,$reguser);

        if($ResultUser){
            echo "<script>alert('Successfully Registered.');  window.location.href='Register.php';</script>";
            exit();
            
        }else{
            echo "Error: " . mysqli_error();
        }


    }
}
?>

<Section class="Reg">
    <div class="registration-form">
        <h3>Create a Profile</h3>
        <form action="" method="post">
            <div class="reg-each"> 
                <label for="name">Username:</label><br>
                <input type="text" name="name" id="name" placeholder="Enter Username"/>
                <small class="text-warning"><?php echo $errors['username']; ?></small>
            </div>
            <div class="reg-each">
                <label for="email">Email:</label><br>
                <input type="email" name="email" id="email" placeholder="Enter Email">
                <small class="text-warning"><?php echo $errors['email']; ?></small>
            </div>
            <div class="reg-each">
                <label for="pass">Password:</label><br>
                <input type="password" name="pass" id="pass" placeholder="Enter Password">
                <small class="text-warning"><?php echo $errors['password']; ?></small>
            </div>
            <div class="reg-each">
                <label for="cpass">Conform Password:</label><br>
                <input type="password" name="cpass" id="cpass" placeholder="Conform Password">
                <small class="text-warning"><?php echo $errors['confirm_password']; ?></small>
            </div>
            <div class="reg-each">
                <label for="role">Role:</label><br>
                <select name="role" id="role">
                    <option value="Employee">Employee</option>
                    <?php
                        if($_SESSION['role'] == "Admin"){

                            echo '<option value="Manager">Manager</option>
                            <option value="Admin">Admin</option>';
                        }
                    ?>
                </select>
            </div>
            <div class="reg-each">
                <input type="submit" value="Submit">
            </div>

        </form>
    </div>
</Section>

<?php
include_once("./includes/footer.php");
?>