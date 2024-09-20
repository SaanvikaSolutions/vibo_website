<?php
session_start(); 
include("./connections/dbconnect.php");
include("./includes/navbar.php");

if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit();
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $EName = mysqli_real_escape_string($con,$_POST['name']);
    $PName = mysqli_real_escape_string($con,$_POST['Pname']);
    $disc = mysqli_real_escape_string($con,$_POST['disc']);
    $Date = mysqli_real_escape_string($con,$_POST['Date']);

    $WorkIQ = "INSERT INTO `work` (`EName`, `PName`, `Date`, `WorkDisc`) VALUES ('$EName', '$PName', '$Date', '$disc')";
    $WorkSQ = mysqli_query($con,$WorkIQ);

    if($WorkSQ){
        echo "<script>alert('Successfully Inserted Work.');  window.location.href = 'workflow.php';</script>";
        exit();
    }else{
        echo "Error: " . mysqli_error();
    }


}

?>


<section id="workflow">
    <?php if($_SESSION['role'] != 'Admin'){ ?>
    <form action="" method="POST">
        <h1 class="WF-heading">Enter Work Done!</h1>

        <div class="WF-fs">
            <div class="WF-EachLabel">
                <label for="name">Name:</label>
                <select name="name" id="name" required>
                    <?php
                        echo '<option value="'. $_SESSION['username'] . '">' .$_SESSION['username'] . '</option>';
                    ?>
                </select>
            </div>
            <div class="WF-EachLabel">
                <label for="Pname">Project Name:</label>
                <select name="Pname" id="Pname" required>
                    <?php
                    $projects = array();
                    $retrivePRes = "Select * from project";
                    $exePRes = mysqli_query($con,$retrivePRes);
                    while($row1 = mysqli_fetch_assoc($exePRes)){
                        
                        $resource = $row1['Resources'];
                        // $string = 'Hello world from PHP';
                        $array = explode(',', $resource);
                        foreach($array as $ar){
                            if($ar == $_SESSION['username']){
                                $projects[] = $row1['PName'];
                            }
                        }

                    }
                    foreach($projects as $pr){
                        echo '<option value="' . $pr. '">' . $pr . '</option>';
                    }

                    // while ($row = mysqli_fetch_assoc($fetPro)) {
                    //     echo '<option value="' . $row['PName'] . '">' . $row['PName'] . '</option>';
                    // }
                ?>
                </select>
            </div>
        </div>
        <div class="WF-fs">
        <div class="WF-EachLabel">
                <label for="disc">Work Done:</label>
                <textarea name="disc" id="disc" cols="30" rows="5" placeholder="Enter Work Done" required></textarea>
            </div>
            <div class="WF-EachLabel">
                <label for="Date">Date:</label>
                <input type="date" name="Date" id="Date"
                    min="<?php echo date('Y-m-d', strtotime('-4 days', strtotime(date('y-m-d')))); ?>" required>
            </div>
        </div>
        <div class="WF-fs">
            <input type="submit" value="Submit">
        </div>

    </form>
    <?php } ?>


    <div class="AE-mid-s">
        <div class="AE-Heading">
            <h2 class="AE-Heading">Work Done</h2>
        </div>
        <div class="AE-Create">
            <button class="AE-create-button">Work Done</button>
        </div>
    </div>

    <div class="flexible-tabel">

        
        <table id="myTable" class="AE-table-s">
            <thead>
            <tr>
                <th>Employee Name</th>
                <th>Project Name</th>
                <th>Date</th>
                <th>Work Done</th>
            </tr>
        </thead>
        <tbody>
            <?php
                    $showquery = "SELECT * FROM `work` WHERE `EName` = '". $_SESSION['username'] ."' ORDER BY Date DESC";
                    $showRes = mysqli_query($con,$showquery);

                    $bgColor = 'grey';
                    $numberofrows = mysqli_num_rows($showRes);
                    if ($numberofrows > 0) {
                        while ($row = mysqli_fetch_assoc($showRes)) {
                            echo '<tr">'; // Assuming you're echoing within a table row
                            echo '<td>' . $row['EName'] . '</td>';
                            echo '<td>' . $row['PName'] . '</td>';
                            echo '<td>' . $row['Date'] . '</td>';
                            echo '<td>' . $row['WorkDisc'] . '</td>';
                            echo '</tr>';
                        }
                    }

                ?>
        </tbody>
    </table>
</div>
</section>


<script>
    $(document).ready(function () {
        $('#myTable').DataTable();
    });
</script>

<?php
include_once("./includes/footer.php");
?>