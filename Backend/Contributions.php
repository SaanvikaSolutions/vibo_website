<?php
session_start(); 
include("./connections/dbconnect.php");
include("./includes/navbar.php");

if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit();
}

$sno = $_GET['PID'];

$count = "Select * from `pdetails` where `PID` = $sno";
$countRes = mysqli_query($con,$count);

$RowCount = mysqli_num_rows($countRes);
if($RowCount >= 1){
    echo "<script>alert('Record Already Exists.'); window.location.href = 'viewFeatures.php?PID=". $sno . "';</script>";
    exit();
}

$projects = "Select * from `project` where `PID` = $sno";
$prores = mysqli_query($con,$projects);
$data = mysqli_fetch_assoc($prores);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $Lead = mysqli_real_escape_string($con, $_POST['nameL']);
    $PName = mysqli_real_escape_string($con, $data['PName']);
    $PID = mysqli_real_escape_string($con, $data['PID']);
    

    $Primary = $_POST['names'];

    // Sanitize each name in the array
    foreach ($Primary as &$name) {
        $name = mysqli_real_escape_string($con, $name);
        $name = substr($name, 0, -1); // Assuming you need to remove the last character
    }
    unset($name); // Break reference link

    // Convert array to comma-separated string
    $Primary = implode(',', $Primary);

    $Substitutes = $_POST['Snames'];

    // Sanitize each name in the array
    foreach ($Substitutes as &$name) {
        $name = mysqli_real_escape_string($con, $name);
        $name = substr($name, 0, -1); // Assuming you need to remove the last character
    }
    unset($name); // Break reference link

    // Convert array to comma-separated string
    $Substitutes = implode(',', $Substitutes); 

    $PQuery = "INSERT INTO `pdetails`(`PLead`, `PRole`, `Substitute`, `ProjectName`, `PID`) VALUES ('$Lead','$Primary','$Substitutes','$PName','$PID')";
        $pushQuery = mysqli_query($con, $PQuery);

        if ($pushQuery) {
            echo "<script>alert('Project Details Inserted Successful.'); window.location.href = 'Projects.php';</script>";
            exit();
        } else {
            echo "Error: " . mysqli_error($con);
        }

}
?>

<section class="cp-form">
    <h1 class="cp-heading">Project Allocation</h1>
    <form action="" method="POST">
        <div class="cp-each-form">
        <div class="cp-each-label">
            <label for="nameL">Project Lead:</label>
                    <select name="nameL" id="nameL" required>
                        <?php
                            $resource1 = $data['Resources'];
                                    
                            $array = explode(',', $resource1);
                            foreach($array as $ar){
                                echo '<option value="'. $ar . '">' .$ar . '</option>';         
                            }
                            
                        ?>
                    </select>
        </div>
            <div class="cp-each-label">
                <label for="Pname">Primary Support</label>
                <div class="cp-checkbox">
                    <?php
                        $resource = $data['Resources'];
                                    
                        $array = explode(',', $resource);
                        foreach($array as $ar){
                            echo '<input type="checkbox" name="names[]" value="' .$ar. '/"> '.$ar;          
                        }
                    ?>
                </div>

            </div>
        </div>
        <div class="cp-each-form">
            <div class="cp-each-label">
                <label for="Pnames">Substitute</label>
                <div class="cp-checkbox">
                    <?php
                        $resource = $data['Resources'];
                                    
                        $array = explode(',', $resource);
                        foreach($array as $ar){
                            echo '<input type="checkbox" name="Snames[]" value="' .$ar. '/"> '.$ar;          
                        }
                    ?>
                </div>

            </div>
        </div>
        
        <div class="cp-each-form">
            <input type="submit" value="Submit">
        </div>



    </form>
</Section>



<?php
include_once("./includes/footer.php");
?>