<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saanvika EMS</title>
    <link rel="icon" href="../Images/Logo/saanvika logo.png" type="image/icon type">
    <link rel="stylesheet" href="./css/Style.css">
    <link rel="stylesheet" href="./css/expences.css">
    <link rel="stylesheet" href="./css/project.css">
    <link rel="stylesheet" href="./css/workflow.css">
    <script src="https://kit.fontawesome.com/b19824e628.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.dataTables.css">
    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>

</head>

<body>
    <nav class="TN-bar">

        <div class="burger">
            <img src="../Images/navigation/bars.png" alt="Navbar" />
        </div>

        <div class="S-logo">
            <img src="../Images/Logo/saanvika logo.png" alt="Saanvika" />
        </div>

        <div class="nav-items">
            <ul>
                <li><a href="./Expences.php">Expenses</a></li>

                
                <?php  
                
                if($_SESSION['role'] != "Admin"){

                    echo '<li><a href="./workflow.php">Workflow Supervision</a></li>';
                }
                
                
                if($_SESSION['role'] == "Admin"){
                    
                    echo '<li><a href="work.php">Workflow</a></li>';
                    echo '<li><a href="./projects.php">Projects</a></li>';
                }
                if($_SESSION['role'] == "Manager" || $_SESSION['role'] == "Admin"){

                    echo '<li><a href="Register.php">Register</a></li>';
                }
                ?>
                
                <li><a href="./logout.php">Logout <i class="fa-solid fa-right-from-bracket"></i></a></li>
            </ul>
        </div>
        <div class="Profile-c"><?php echo $_SESSION['Profile']; ?></div>


    </nav>

    <div class="pBox">
        <div class="cross">
            <i class="fa-solid fa-x"></i>
        </div>

        <div class="content11">
            <div class="Profile-cc"><?php echo $_SESSION['Profile']; ?></div>
            <div class="profile-capsule">
                <div class="cap cap-left"><a href="./profile.php">Profile</a></div>
                <div class="cap cap-right"><a href="./logout.php">Logout <i class="fa-solid fa-right-from-bracket"></i></a></div>
            </div>
        </div>
    </div>
    
    