<?php
session_start(); 
include("./connections/dbconnect.php");
include("./includes/navbar.php");

if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit();
}
$sno = $_GET['Sno'];
?>

<section class="cp-form" style="margin-bottom:50px;">
    <h1 class="cp-heading">Update Project</h1>
    <form action="" method="POST">
        <?php 
                    $fetchque = "Select * from `project` where `PID` = '$sno'";
                    $fetchres = mysqli_query($con, $fetchque);
                    $row = mysqli_fetch_assoc($fetchres); 
                    
                    $pname = $row['PName'];

                    $agenda = $row['Agenda'];
                    $Features = $row['Features'];
                    $FDATE = $row['FDate'];
                    $TDATE = $row['TDate'];
                    $cmt = $row['Pcomments'];
                            
        ?>
        <div class="cp-each-form">
            <div class="cp-each-label">
                <label for="ProjectN">Project Name </label>
                <input type="text" name="ProjectN" id="ProjectN" value="<?=  $row['PName'];  ?>" required>
            </div>
            
            <div class="cp-each-label">
                <label for="Pname">Resources </label>
                <div class="cp-checkbox">
                <?php
                    $allUser = "SELECT * FROM `user` WHERE `Role` != 'Admin'";
                    $fetchUser = mysqli_query($con,$allUser);

                    $num = mysqli_num_rows($fetchUser);
                    $count = 0;
                    
                    while($row = mysqli_fetch_assoc($fetchUser)){

                        $usersSelect = array();
                            $retrivePRes = "Select * from project where `PID` = '$sno'";
                            $exePRes = mysqli_query($con,$retrivePRes);
                            $row1 = mysqli_fetch_assoc($exePRes);
                            // while($row1 = mysqli_fetch_assoc($exePRes)){
                                
                                $resource = $row1['Resources'];
                                $bool = false;
                                
                                $array = explode(',', $resource);
                                foreach($array as $ar){
                                    if($ar == $row['Username']){
                                        $bool = TRUE;
                                        break;
                                    }
                                }

                            // }

                        if($bool == TRUE){

                            echo '<input type="checkbox" name="names[]" value="' .$row["Username"]. '/" checked> '.$row["Username"];
                        }else{
                            echo '<input type="checkbox" name="names[]" value="' .$row["Username"]. '/"> '.$row["Username"];

                        }
                        
                        if(abs($num/2 - 1 ) == $count){
                            echo '<br>';
                        }
                        // echo "<br>";
                        $count++;
                    }
                ?>
                </div>

            </div>
        </div>
        
        <div class="cp-each-form">
            <div class="cp-each-label">
                <label for="Agenda">Agenda</label>
                <textarea name="Agenda" id="Agenda" cols="20" rows="5"><?php echo $agenda; ?></textarea>
            </div>
            <div class="cp-each-label">
                <label for="Features">Features</label>
                <textarea name="Features" id="Features" cols="20" rows="5"> <?php echo $Features;  ?> </textarea>
            </div>
        </div>
        <div class="cp-each-form">
            <div class="cp-each-label">
                <label for="FDate">From Date</label>
                <input type="date" name="FDate" value="<?=  $FDATE;  ?>" id="FDate" required>
            </div>
            <div class="cp-each-label">
                <label for="TDate">To Date</label>
                <input type="date" name="TDate" value="<?=  $TDATE;  ?>" id="TDate" required>
            </div>
        </div>
        <div class="cp-each-form">
            <div class="cp-each-label">
                <label for="cmt">Comment</label>
                <input type="text" name="cmt"  id="cmt" value="<?= $cmt;  ?>">
            </div>
            <div class="cp-each-label">
                <label for="status">Status</label>
                <Select name="status" id="status" required>
                    <option value="Inprogress">Inprogress</option>
                    <option value="Extended">Extended</option>
                    <option value="Completed">Completed</option>
                </Select>
            </div>
        </div>
        <div class="cp-each-form">
            <input type="submit" value="Update">
        </div>

    </form>
</section>

<?php 
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $ProjectN = mysqli_real_escape_string($con,$_POST['ProjectN']);

    $namesQ = "SELECT `Resources` FROM `project` WHERE `PName` = '$pname'";
    // $name = mysqli_query($con, $namesQ);


    $Agenda = mysqli_real_escape_string($con,$_POST['Agenda']);
    $Features = mysqli_real_escape_string($con,$_POST['Features']);
    $FDate = mysqli_real_escape_string($con,$_POST['FDate']);
    $TDate = mysqli_real_escape_string($con,$_POST['TDate']);
    $cmt = mysqli_real_escape_string($con,$_POST['cmt']);
    $status = mysqli_real_escape_string($con,$_POST['status']);

    // while ($item = mysqli_fetch_assoc($name)) {
        // $itemValue = $item['Resources']; // Assuming 'Resources' is the correct field name

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
    
        $PQuery = "UPDATE `project` SET `PName` = '$ProjectN', `Resources`= '$names',`Agenda` = '$Agenda', `Features` = '$Features', `FDate` = '$FDate', `TDate` = '$TDate', `Pcomments` = '$cmt', `PStatus` = '$status' WHERE `PID` = '$sno'";
    
        $pushQuery = mysqli_query($con, $PQuery);
    }
    

    // INSERT INTO `project` (`PID`, `PName`, `Resources`, `Agenda`, `Features`, `FDate`, `TDate`, `Pcomments`, `PStatus`) VALUES (NULL, 'Something', 'Jagdish', 'Something', 'Something', '2024-04-29', '2024-05-31', 'sth', 'InProgress');



    if($pushQuery){
        echo "<script>alert('Successfully Updated Project.'); window.location.href = 'Projects.php';</script>";
        exit();
        
    }else{
        echo "Error: " . mysqli_error();
    }

}
?>

<script>
    // Accessing the elements
    let ExpMod = document.querySelector(".Expence-modal");
    let ModalVis = document.querySelector(".AE-create-button");

    // Adding event listener
    // ModalVis.addEventListener("click", () => {
    //     ExpMod.classList.toggle("Expence-modal-visible");
    // });
    document.addEventListener("DOMContentLoaded", () => {
        let clMod = document.querySelector(".close-modal i");
        console.log('clMod');

        clMod.addEventListener("click", () => {
            window.location.href = "Projects.php";
        });
    });

</script>


<?php
include_once("./includes/footer.php");
?>