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
    <h2>Contact Details <small>Displaying Contact Details</small></h2>
    <table class="responsive-table">
        <thead>
            <tr>
                <th><span>SNo</span></th>
                <th><span>Name</span></th>
                <th><span> Contact No</span></th>
                <th><span>Email</span></th>
                <th><span> Message</span></th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
                $showquery = "SELECT * FROM `contact`";
                $showRes = mysqli_query($con, $showquery);
                $sno = 1; // To track serial numbers

                $numberofrows = mysqli_num_rows($showRes);
                if ($numberofrows > 0) {
                    while ($row = mysqli_fetch_assoc($showRes)) {
                        echo '<tr>';
                        echo '<td>' . $sno++ . '</td>'; // Display SNo
                        echo '<td>' . $row['Name'] . '</td>';
                        echo '<td>' . $row['Contact_Number'] . '</td>';
                        echo '<td>' . $row['Email'] . '</td>';
                        echo '<td>' . $row['Comments'] . '</td>';
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
    $delete_query = "DELETE FROM `contact` WHERE `id` = $id";
    $result_query = mysqli_query($con, $delete_query);

    if ($result_query) {
        echo "<script>alert('Deleted successfully'); window.location.href = 'contact.php';</script>";
    } else {
        echo "<script>alert('Error deleting record'); window.location.href = 'contact.php';</script>";
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
            document.location.href = `contact.php?delete_id=${id}`;
        }
    }
</script>

<script src="app.js"></script>
