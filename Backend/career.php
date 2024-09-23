<?php
include("sidebar.php");
include('./connections/dbconnect.php');

// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    // Redirect to the login page if not logged in
    header("Location: Register.php");
    exit();
}
?>

<div class="container">
    <h2>Career Details <small>Displaying Career Details</small></h2>
    <table class="responsive-table">
        <thead>
            <tr>
                <th><span>SNo</span></th>
                <th><span>First Name</span></th>
                <th><span>Last Name</span></th>
                <th><span>Email</span></th>
                <th><span> Contact No</span></th>
                <th><span>Alt Contact No</span></th>
                <th><span>Resume</span></th>
                <th><span> Message</span></th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
                $showquery = "SELECT * FROM `career`";
                $showRes = mysqli_query($con, $showquery);
                $sno = 1; // To track serial numbers

                $numberofrows = mysqli_num_rows($showRes);
                if ($numberofrows > 0) {
                    while ($row = mysqli_fetch_assoc($showRes)) {
                        echo '<tr>';
                        echo '<td>' . $sno++ . '</td>'; // Display SNo
                        echo '<td>' . $row['First_Name'] . '</td>';
                        echo '<td>' . $row['Last_Name'] . '</td>';
                        echo '<td>' . $row['Email Id'] . '</td>';
                        echo '<td>' . $row['Mobile_Number'] . '</td>';
                        echo '<td>' . $row['Alternate Mobile_No'] . '</td>';
                        echo '<td><button style="background-color: blue; color: aliceblue; border-radius: 8px; padding: 5px;"><a href="./Files/' . $row['Resume'] . '" target="_blank" style="text-decoration: none; color: white;">View Resume</i></a></button></td>';
                        echo '<td>' . $row['Message'] . '</td>';
                        echo '<td><button style="background-color: red; color: aliceblue; border-radius: 8px; padding: 5px;"><a href="javascript:void()" style="text-decoration: none; color: white;" onClick="chkalert('.$row['id'].')">Delete</a></button></td>';
                        echo '</tr>';
                    }
                }
            ?>
        
        </tbody>
    </table>
</div>
<?php
if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    $delete_query = "DELETE FROM `career` WHERE `id` = $id";
    $result_query = mysqli_query($con, $delete_query);

    if ($result_query) {
        echo "<script>alert('Deleted successfully'); window.location.href = 'career.php';</script>";
    } else {
        echo "<script>alert('Error deleting record'); window.location.href = 'career.php';</script>";
    }
}
?>

<script>
    $(document).ready(function () {
        $('#myTable').DataTable();
    });
</script>
<script type="text/javascript">
    function chkalert(id) {
        let sts = confirm('Are you sure you want to delete it?');
        if (sts) {
            document.location.href = `career.php?delete_id=${id}`;
        }
    }
</script>

<script src="app.js"></script>
