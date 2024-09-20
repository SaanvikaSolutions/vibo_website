<?php
session_start(); 
include("./connections/dbconnect.php");
include("./includes/navbar.php");

if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit();
}


$sno = $_GET['PID'];
$projects = "Select * from `project` where `PID` = $sno";
$prores = mysqli_query($con,$projects);
$data = mysqli_fetch_assoc($prores);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $FeatureN = mysqli_real_escape_string($con, $_POST['FeatureN']);
    $disc = mysqli_real_escape_string($con, $_POST['disc']);
    $FDate = mysqli_real_escape_string($con, $_POST['FDate']);
    $TDate = mysqli_real_escape_string($con, $_POST['TDate']);
    $TDate = mysqli_real_escape_string($con, $_POST['TDate']);
    $ProjectName = $data['PName'];
    $Pid = $data['PID'];
    $status = mysqli_real_escape_string($con, $_POST['status']);
    

    if (isset($_POST['names']) && is_array($_POST['names'])) {
        $names = $_POST['names'];
        
        // Sanitize each name in the array
        foreach ($names as &$name) {
            $name = mysqli_real_escape_string($con, $name);
            $name = substr($name, 0, -1); // Assuming you need to remove the last character
        }
        unset($name); // Break reference link

        // Convert array to comma-separated string
        $names = implode(',', $names);

        // Insert into database
        $PQuery = "INSERT INTO `features`(`FeatureName`, `ProjectName`, `FeatureDiscription`, `SDate`, `EDate`, `PWorking`, `PID`, `FStatus`) VALUES ('$FeatureN','$ProjectName','$disc','$FDate','$TDate','$names','$Pid','$status')";
        $pushQuery = mysqli_query($con, $PQuery);

        if ($pushQuery) {
            echo "<script>alert('Successfully Created Project.'); window.location.href = 'Projects.php';</script>";
            exit();
        } else {
            echo "Error: " . mysqli_error($con);
        }
    } else {
        echo "No names provided or names are not in the correct format.";
    }
}


?>


<section class="cp-form">
    <h1 class="cp-heading">Add Feature</h1>
    <form action="" method="POST">
        <div class="cp-each-form">
            <div class="cp-each-label">
                <label for="FeatureN">Feature Name </label>
                <input type="text" name="FeatureN" id="FeatureN" placeholder="Enter The Feature Name" required>
            </div>
            <div class="cp-each-label">
                <label for="Pname">Resources </label>
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
                <label for="disc">Feature Discription</label>
                <textarea name="disc" id="disc" cols="20" rows="5" placeholder="Enter The Agenda"></textarea>
            </div>
            <!-- <div class="cp-each-label">
                <label for="Features">Features</label>
                <textarea name="Features" id="Features" cols="20" rows="5" placeholder="Enter The Features"></textarea>
            </div> -->
        </div>
        <div class="cp-each-form">
            <div class="cp-each-label">
                <label for="FDate">From Date</label>
                <input type="date" name="FDate" min="<?= $data['FDate']  ?>" max="<?= $data['TDate']  ?>" id="FDate" required>
            </div>
            <div class="cp-each-label">
                <label for="TDate">To Date</label>
                <input type="date" name="TDate" id="TDate" min="<?= $data['FDate']  ?>" max="<?= $data['TDate']  ?>" required>
            </div>
        </div>
        <div class="cp-each-form">
            
            <div class="cp-each-label">
                <label for="status">Status</label>
                <Select name="status" id="status" required>
                    <option value="Inprogress">Inprogress</option>
                    <option value="Extended">Extended</option>
                    <option value="Completed">Completed</option>
                    <!-- <option value="Completed">Completed</option> -->
                </Select>
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