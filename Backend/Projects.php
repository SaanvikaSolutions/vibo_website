<?php
session_start(); 
include("./connections/dbconnect.php");
include("./includes/navbar.php");

if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ProjectN = mysqli_real_escape_string($con, $_POST['ProjectN']);
    $Agenda = mysqli_real_escape_string($con, $_POST['Agenda']);
    $Features = mysqli_real_escape_string($con, $_POST['Features']);
    $FDate = mysqli_real_escape_string($con, $_POST['FDate']);
    $TDate = mysqli_real_escape_string($con, $_POST['TDate']);
    $cmt = mysqli_real_escape_string($con, $_POST['cmt']);
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
        $PQuery = "INSERT INTO `project` (`PName`, `Resources`, `Agenda`, `Features`, `FDate`, `TDate`, `Pcomments`, `PStatus`) VALUES ('$ProjectN', '$names', '$Agenda', '$Features', '$FDate', '$TDate', '$cmt', '$status')";
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
    <h1 class="cp-heading">Create Project</h1>
    <form action="" method="POST">
        <div class="cp-each-form">
            <div class="cp-each-label">
                <label for="ProjectN">Project Name </label>
                <input type="text" name="ProjectN" id="ProjectN" placeholder="Enter The Project Name" required>
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
                        echo '<input type="checkbox" name="names[]" value="' .$row["Username"]. '/"> '.$row["Username"];
                        
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
                <textarea name="Agenda" id="Agenda" cols="20" rows="5" placeholder="Enter The Agenda"></textarea>
            </div>
            <div class="cp-each-label">
                <label for="Features">Features</label>
                <textarea name="Features" id="Features" cols="20" rows="5" placeholder="Enter The Features"></textarea>
            </div>
        </div>
        <div class="cp-each-form">
            <div class="cp-each-label">
                <label for="FDate">From Date</label>
                <input type="date" name="FDate" id="FDate" required>
            </div>
            <div class="cp-each-label">
                <label for="TDate">To Date</label>
                <input type="date" name="TDate" id="TDate" required>
            </div>
        </div>
        <div class="cp-each-form">
            <div class="cp-each-label">
                <label for="cmt">Comment</label>
                <input type="text" name="cmt" id="cmt" placeholder="Enter a Comment">
            </div>
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


    <div class="AE-mid-s">
        <div class="AE-Heading">
            <h2 class="AE-Heading">Projects</h2>
        </div>
        <div class="AE-Create">
            <button class="AE-create-button">All Projects</button>
        </div>
    </div>

    <div class="tabel-container">
        <table id="myTable" class="AE-table-s">
            <thead>
                <tr>
                    <th>Project Id</th>
                    <th>Project Name</th>
                    <th>Working Employee</th>
                    <th>Agenda</th>
                    <th>Features</th>
                    <th>Start Date</th>
                    <th>Exp. End Date</th>
                    <th>Comments</th>
                    <th>Features</th>
                    <th>Assign</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    // $showquery = "SELECT DISTINCT `PName`, * FROM `project`";
                    $showquery = "SELECT * FROM project WHERE PID IN (
                        SELECT MIN(PID) FROM project GROUP BY PName
                    )";
                    $showRes = mysqli_query($con,$showquery);
                    
                    // if($_SESSION['role'] == "Admin"){

                    // }

                    $bgColor = 'grey';
                    $numberofrows = mysqli_num_rows($showRes);
                    if ($numberofrows > 0) {
                        // Fetch rows one by one using a while loop
                        while ($row = mysqli_fetch_assoc($showRes)) {
                            if( $row['PStatus'] === 'Inprogress'){
                                $bgColor = '#C2F1C1';
    
                            }
                            if( $row['PStatus'] === 'Completed'){
                                $bgColor = '#FFC0C0';
    
                            }
                            if( $row['PStatus'] === 'Extended'){
                                $bgColor = 'lightgrey';
    
                            }
                            // if( $row['Status'] === 'Close'){
                            //     $bgColor = '#C6D5DB';
    
                            // }
                            echo '<tr style="background-color: ' . $bgColor . ';">'; 
                            $empName = "SELECT `Resources` FROM `project` WHERE `PName` = '" . mysqli_real_escape_string($con, $row['PName']) . "'";
                            $showEmp = mysqli_query($con, $empName);
                            // echo '<tr">'; // Assuming you're echoing within a table row
                            echo '<td>' . $row['PID'] . '</td>';
                            echo '<td>' . $row['PName'] . '</td>';
                            echo '<td>';
                            while ($row1 = mysqli_fetch_assoc($showEmp)) {
                                echo htmlspecialchars($row1['Resources']) . ' ';
                            }
                            echo '</td>';
                            echo '<td>' . $row['Agenda'] . '</td>';
                            echo '<td>' . $row['Features'] . '</td>';
                            echo '<td>' . $row['FDate'] . '</td>';
                            echo '<td>' . $row['TDate'] . '</td>';
                            echo '<td>' . $row['Pcomments'] . '</td>';

                            if($row['PStatus'] != 'Completed'){
                                echo '<td><button><a href="./Features.php?PID='. $row['PID'] . '"><i  class="fa-solid fa-plus"></i></a></button>';
                            }else{
                                echo '<td>';
                            }
                            echo ' <button><a href="./viewFeatures.php?PID='. $row['PID'] . '")" ><i class="fa-solid fa-eye"></i></a></button></td>';
                            echo ' <td> <button><a href="./Contributions.php?PID='. $row['PID'] . '")" ><i class="fa-solid fa-plus"></i></a></button></td>';
                            
                            echo '<td>' . $row['PStatus'] . '</td>';
                            if($row['PStatus'] != 'Completed'){
                                echo '<td><button><a href="./Update_Project.php?Sno=' . $row['PID'] . '"><i class="fa-solid fa-pen-to-square"></i></a></button>';
                            }else{
                                echo '<td>';
                            }
                            echo ' <button><a href="javascript:void()" onClick="chkalert('.$row['PID'].')" ><i class="fa-solid fa-trash"></i></a></button></td>';
                            echo '</tr>';
                        }
                    }

                ?>
            </tbody>
        </table>
    </div>



</section>

<?php
if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];

    // Select query to fetch images associated with the product
    $select_query = "DELETE FROM `project` WHERE `PID` = $id";
    $result_query = mysqli_query($con, $select_query);

    if ($result_query) {
        echo "<script>alert('Deleted successfully'); window.location.href = 'Projects.php';</script>";
            exit();

    }
    else {
        echo "<script>alert('Error deleting record'); window.location.href = 'Projects.php';</script>";
    }
}
// else {
//     echo "<script>alert('Error fetching images'); window.location.href = 'Expences.php';</script>";
// }

?>

<script>
    $(document).ready(function () {
        $('#myTable').DataTable();
    });
</script>

<script type="text/javascript">
    function chkalert(id) {
        sts = confirm('are you sure you want to delete it.');
        if (sts) {
            document.location.href = `Projects.php?delete_id=${id}`
        }
    }
</script>



<?php
include_once("./includes/footer.php");
?>