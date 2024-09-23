<?php
session_start();
include('./connections/dbconnect.php');

// Variables
$email = $password = "";
$error = array('email' => '', 'password' => '', 'general' => '');
$active_form = ""; // Initialize the active form

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['signup'])) {
        $active_form = "signup"; // User submitted the signup form
        // Registration logic
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $password = mysqli_real_escape_string($con, $_POST['pswd']);

        // Validate form inputs
        if (empty($email)) {
            $error['email'] = "Email is required";
        }
        if (empty($password)) {
            $error['password'] = "Password is required";
        }

        // If no errors, proceed
        if (!array_filter($error)) {
            // Check if email already exists
            $query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
            $result = mysqli_query($con, $query);
            $user = mysqli_fetch_assoc($result);

            if ($user) {
                $error['email'] = "Email already exists";
            } else {
                // Hash password and insert user
                $password = password_hash($password, PASSWORD_DEFAULT);
                $sql = "INSERT INTO `users`(`email`, `password`) VALUES ('$email','$password')";

                if (mysqli_query($con, $sql)) {
                    $_SESSION['email'] = $email;
                    header('Location: career.php'); // Redirect to career page after registration
                    exit();
                } else {
                    $error['general'] = "Registration failed. Please try again.";
                }
            }
        }
    }

    if (isset($_POST['login'])) {
        $active_form = "login"; // User submitted the login form
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $password = mysqli_real_escape_string($con, $_POST['pswd']);

        // Validate login form
        if (empty($email) || empty($password)) {
            $error['general'] = "Email and password are required.";
        } else {
            // Retrieve user from the database
            $query = "SELECT * FROM users WHERE email='$email'";
            $result = mysqli_query($con, $query);

            if (mysqli_num_rows($result) == 1) {
                $user = mysqli_fetch_assoc($result);
                if (password_verify($password, $user['password'])) {
                    // Set session variable
                    $_SESSION['email'] = $user['email'];
                    header('Location: career.php'); // Redirect to career page after successful login
                    exit();
                } else {
                    $error['general'] = "Incorrect password.";
                }
            } else {
                $error['general'] = "No user found with this email.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login Page</title>
  <link rel="stylesheet" href="register.css">
  <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
</head>
<body>
<div class="reg_login">
    <div class="main">    
      <input type="checkbox" id="chk" aria-hidden="true">

      <!-- Sign up Form --> 
      <div class="signup">
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
          <label for="chk" aria-hidden="true">Sign up</label>
          <input type="email" name="email" placeholder="Email" required="" value="<?php echo htmlspecialchars($email); ?>">
          <span class="error"><?php echo $error['email']; ?></span>

          <input type="password" name="pswd" placeholder="Password" required="">
          <span class="error"><?php echo $error['password']; ?></span>
          
          <button name="signup">Sign up</button>
        </form>
      </div>

      <!-- Login Form -->
      <div class="login">
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
          <label for="chk" aria-hidden="true">Login</label>
          <input type="email" name="email" placeholder="Email" required="" value="<?php echo htmlspecialchars($email); ?>">
          <input type="password" name="pswd" placeholder="Password" required="">
          <span class="error"><?php echo $error['general']; ?></span>
          
          <button name="login">Login</button>
        </form>
      </div>
    </div>
</div>

<!-- JavaScript to preserve the form state after submit -->
<script>
    // If login form was active, toggle the checkbox to display the login form
    const activeForm = "<?php echo isset($active_form) ? $active_form : ''; ?>";
    if (activeForm === "login") {
      document.getElementById('chk').checked = true;
    }
</script>
</body>
</html>
