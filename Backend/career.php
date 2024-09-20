<?php
session_start(); 
include("./connections/dbconnect.php");
include("./includes/navbar.php");

if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit();
}
?>

<div class="tabel-container">
        <table id="myTable" class="AE-table-s">
            <thead>
                <tr>
                    <th>SNo</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Contact No</th>
                    <th>Resume</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                        $showquery = "SELECT * FROM `career`";
                        $showRes = mysqli_query($con,$showquery);

            

                        // $bgColor = 'grey';
                        $numberofrows = mysqli_num_rows($showRes);
                        if ($numberofrows > 0) {

                            
                            // Fetch rows one by one using a while loop
                            while ($row = mysqli_fetch_assoc($showRes)) {
                                
                                echo '<tr>'; // Assuming you're echoing within a table row
                                echo '<td>' . $row['cno'] . '</td>';
                                echo '<td>' . $row['fname'] . '</td>';
                                echo '<td>' . $row['lname'] . '</td>';
                                echo '<td>' . $row['email'] . '</td>';
                                echo '<td>' . $row['contactNo'] . '</td>';
                                echo '<td><a href="../files/'. $row['resume'].'" target="_blank"><i class="fa-solid fa-eye"></i></a></td>';
                                echo '<td><button><a href="javascript:void()" onClick="chkalert('.$row['cno'].')" ><i class="fa-solid fa-trash"></i></a></button></td>';
                                // if($row['Status'] != 'Close'){
                                //     echo '<td><button><a href="update_Expences.php?Sno=' . $row['UID'] . '"><i class="fa-solid fa-pen-to-square"></i></a></button>';
                                // }else{
                                //     echo '<td>';
                                // }
                                // echo ' <button><a href="javascript:void()" onClick="chkalert('.$row['UID'].')" ><i class="fa-solid fa-trash"></i></a></button></td>';
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

    // Select query to fetch images associated with the product
    $select_query = "DELETE FROM `career` WHERE `cno` = $id";
    $result_query = mysqli_query($con, $select_query);

    if ($result_query) {
        echo "<script>alert('Deleted successfully'); window.location.href = 'career.php';</script>";
            exit();

    }
    else {
        echo "<script>alert('Error deleting record'); window.location.href = 'career.php';</script>";
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
        function chkalert(id){
            sts = confirm('are you sure you want to delete it.');
            if(sts){
                document.location.href=`career.php?delete_id=${id}`
            }
        }
</script>

<?php
include_once("./includes/footer.php");
?>