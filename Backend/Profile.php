<?php
session_start(); 
include("./connections/dbconnect.php");
include("./includes/navbar.php");

if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit();
}
// Define variables to store validation error messages
$errors = array('opas' => '', 'npas' => '', 'cpas' => '');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $opas = mysqli_real_escape_string($con, $_POST['opass']);
    $npas = mysqli_real_escape_string($con, $_POST['Npass']);
    $cpas = mysqli_real_escape_string($con, $_POST['cpass']);

    // Checking the error in username
    if (empty($_POST["opass"])) {
        $errors['opas'] = "Old Password required";
    }
    $paswdCheck = "SELECT `Password` FROM `user` WHERE `UID` = '" . $_SESSION['id'] . "'";
    $passRes = mysqli_query($con,$paswdCheck);
    if($_POST["opass"] != $passRes){
        $errors['opas'] = "Enter Correct Old Password";
    }

    if (empty($_POST["Npass"])) {
        $errors['npas'] = "New Password required";
    } else {
        if (strlen($npas) < 8) {
            $errors['npas'] = 'Password must be at least 8 characters long';
        }
    }

    if (empty($_POST["cpass"])) {
        $errors['cpas'] = "Confirm Password required";
    } else {
        if ($_POST["cpass"] != $_POST["Npass"]) {
            $errors['cpas'] = "Confirm Password doesn't match";
        }
    }

    if (empty($errors['opas']) && empty($errors['npas']) && empty($errors['cpas'])) {
        if ($opas == $npas) {
            echo "Error: New password should be different from the old password.";
        } else {
            $expQuery = "UPDATE `user` SET `Password`='$npas' WHERE `UID` = '" . $_SESSION['id'] . "'";
            $expRes = mysqli_query($con, $expQuery);

            if ($expRes) {
                echo "<script>alert('Successfully Updated Password.'); window.location.href = 'Profile.php';</script>";
                exit();
            } else {
                echo "Error updating password: " . mysqli_error($con);
            }
        }
    }
}

?>

<section id="profile">

    <!-- <div class="tps">
        <div class="Profile-cc"><?php echo $_SESSION['Profile']; ?></div>
    </div> -->

    <div class="tabel-container">
        <table id="myTable" class="AE-table-s">
            <thead>
                <tr>
                    <th>User Data</th>
                    <th>User Value</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $showquery = "SELECT * FROM `user` WHERE `Username` = '{$_SESSION['username']}'";
                    $showRes = mysqli_query($con,$showquery);

                    $numberofrows = mysqli_num_rows($showRes);
                    if ($numberofrows > 0) {
                        $row = mysqli_fetch_assoc($showRes);

                        echo "<tr>";
                        echo "<td> Username </td>";
                        echo "<td>". $row['Username'] ."</td>";
                        echo "</tr>";

                        echo "<tr>";
                        echo "<td> Email </td>";
                        echo "<td>". $row['Email'] ."</td>";
                        echo "</tr>";

                        echo "<tr>";
                        echo "<td> Role </td>";
                        echo "<td>". $row['Role'] ."</td>";
                        echo "</tr>";
                    }
                    

                ?>
                <tr>
                    <td> Organization</td>
                    <td>Saanvika Software Solution</td>
                </tr>
            </tbody>
        </table>

    </div>

    <?php
    if($_SESSION['role'] == 'Admin'){ $count = 1; ?>

        <div class="tabel-container">
            <h1 style="padding:10px 10px;padding-bottom:0px">Staff Details</h1>
            <table id="myTable" class="AE-table-s">
                <thead>
                    <tr>
                        <th>S.no</th>
                        <th>Username</th>
                        <th>Projects</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $showquery = "SELECT * FROM `user` WHERE `Role` != '{$_SESSION['role']}'";
                        $showRes = mysqli_query($con,$showquery);

                        $numberofrows = mysqli_num_rows($showRes);
                        while($row = mysqli_fetch_assoc($showRes)){
                            echo "<tr>";
                            echo '<td>' . $count . '</td>';
                            echo '<td>' . $row['Username'] . '</td>';

                            $projects = array();
                            $retrivePRes = "Select * from project";
                            $exePRes = mysqli_query($con,$retrivePRes);
                            while($row1 = mysqli_fetch_assoc($exePRes)){
                                
                                $resource = $row1['Resources'];
                                // $string = 'Hello world from PHP';
                                $array = explode(',', $resource);
                                foreach($array as $ar){
                                    if($ar == $row['Username']){
                                        $projects[] = $row1['PName'];
                                    }
                                }

                            }
                            echo '<td>';
                            foreach($projects as $pr){
                                echo $pr;
                            }

                            
                            
                            echo '</td>';
                            echo '<td>' . $row['Email'] . '</td>';
                            echo '<td>' . $row['Role'] . '</td>';
                            echo ' <td><button><a href="javascript:void()" onClick="chkalert('.$row['UID'].')" ><i class="fa-solid fa-trash"></i></a></button></td>';
                            echo "</tr>";
                            $count++;
                        }
                        

                    ?>
                </tbody>
            </table>

        </div>

    <?php } ?>

        <div class="pass-change">
            <h1>Change Password</h1>
            <form action="" method="post">
                <div class="each-label">
                    <label for="opass">Old Password:</label>
                    <div class="each-input1">
                        <input type="password" id="opass" name="opass" class="each-input">
                        <i class="show-password-icon fa-solid fa-eye" data-target="opass"></i>
                    </div>
                    <small class="text-warning">
                        <?php echo $errors['opas']; ?>
                    </small>
                </div>
                <div class="each-label">
                    <label for="Npass">New Password:</label>
                    <div class="each-input1">
                        <input type="password" id="Npass" name="Npass" class="each-input">
                        <i class="show-password-icon fa-solid fa-eye" data-target="Npass"></i>
                    </div>
                    <small class="text-warning">
                        <?php echo $errors['npas']; ?>
                    </small>
                </div>
                <div class="each-label">
                    <label for="cpass">Conform Password:</label>
                    <div class="each-input1">
                        <input type="password" id="cpass" name="cpass" class="each-input">
                        <i class="show-password-icon fa-solid fa-eye" data-target="cpass"></i>
                    </div>
                    <small class="text-warning">
                        <?php echo $errors['cpas']; ?>
                    </small>
                </div>
                <input type="submit" value="Change Password">
            </form>
        </div>
    </section>

<?php
if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];

    // Select query to fetch images associated with the product
    $select_query = "DELETE FROM `user` WHERE `UID` = $id";
    $result_query = mysqli_query($con, $select_query);

    if ($result_query) {
        echo "<script>alert('Deleted successfully'); window.location.href = 'Profile.php';</script>";
            exit();

    }
    else {
        echo "<script>alert('Error deleting record'); window.location.href = 'Profile.php';</script>";
    }
}
// else {
//     echo "<script>alert('Error fetching images'); window.location.href = 'Expences.php';</script>";
// }

?>

<script type="text/javascript">
        function chkalert(id){
            sts = confirm('are you sure you want to delete it.');
            if(sts){
                document.location.href=`Profile.php?delete_id=${id}`
            }
        }
</script>

<script>
    document.querySelectorAll(".show-password-icon").forEach(icon => {
        icon.addEventListener("click", () => {
            var targetId = icon.getAttribute("data-target");
            var passwordField = document.getElementById(targetId);

            if (passwordField.type === "password") {
                passwordField.type = "text"; // Show password
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash"); // Change icon to show it's hiding password
            } else {
                passwordField.type = "password"; // Hide password
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye"); // Change icon to show it's showing password
            }
        });
    });

</script>

<?php
include_once("./includes/footer.php");
?>