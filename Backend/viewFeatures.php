<?php
session_start(); 
include("./connections/dbconnect.php");
include("./includes/navbar.php");

if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit();
}


$sno = $_GET['PID'];
$projects = "Select * from `features` where `PID` = $sno";
$prores = mysqli_query($con,$projects);
// $data = mysqli_fetch_assoc($prores);

$count = "Select * from `pdetails` where `PID` = $sno";
$countRes = mysqli_query($con,$count);

?>

<section id="viewFeatures">
<div class="tabel-container">
            <h1 style="padding:10px 10px;padding-bottom:0px">Project Workforce Details</h1>
            <table id="myTable" class="AE-table-s">
                <thead>
                    <tr>
                        <th>S.no</th>
                        <th>Project Name</th>
                        <th>Project Lead</th>
                        <th>Primary contributors</th>
                        <th>Substitute</th>
                        
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        // $showquery = "SELECT * FROM `features` WHERE `Role` != '{$_SESSION['role']}'";
                        // $showRes = mysqli_query($con,$showquery);
                        $count = 1;

                        // $numberofrows = mysqli_num_rows($showRes);
                        while($data1 = mysqli_fetch_assoc($countRes)){
                            echo "<tr>";
                            echo '<td>' . $count . '</td>';
                            echo '<td>' . $data1['ProjectName'] . '</td>';
                            echo '<td>' . $data1['PLead'] . '</td>';
                            echo '<td>' . $data1['PRole'] . '</td>';
                            echo '<td>' . $data1['Substitute'] . '</td>';
                            
                            echo ' <td><button><a href="javascript:void()" onClick="chkalert()" ><i class="fa-solid fa-trash"></i></a></button></td>';
                            echo "</tr>";
                            $count++;
                        }
                        

                    ?>
                </tbody>
            </table>

        </div>

        <div class="tabel-container">
            <h1 style="padding:10px 10px;padding-bottom:0px">Features Details</h1>
            <table id="myTable" class="AE-table-s">
                <thead>
                    <tr>
                        <th>S.no</th>
                        <th>Project Name</th>
                        <th>Feature Name</th>
                        <th>People Working</th>
                        <th>Discription</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        // $showquery = "SELECT * FROM `features` WHERE `Role` != '{$_SESSION['role']}'";
                        // $showRes = mysqli_query($con,$showquery);
                        $count = 1;
                        $bgColor = 'grey';

                        // $numberofrows = mysqli_num_rows($showRes);
                        while($data = mysqli_fetch_assoc($prores)){

                            if( $data['FStatus'] === 'Inprogress'){
                                $bgColor = '#C2F1C1';
    
                            }
                            if( $data['FStatus'] === 'Completed'){
                                $bgColor = '#FFC0C0';
    
                            }
                            if($data['FStatus'] === 'Extended'){
                                $bgColor = 'lightgrey';
    
                            }

                            echo '<tr  style="background-color: ' . $bgColor . ';" >';
                            echo '<td>' . $count . '</td>';
                            echo '<td>' . $data['ProjectName'] . '</td>';
                            echo '<td>' . $data['FeatureName'] . '</td>';
                            echo '<td>' . $data['PWorking'] . '</td>';
                            echo '<td>' . $data['FeatureDiscription'] . '</td>';
                            echo '<td>' . $data['SDate'] . '</td>';
                            echo '<td>' . $data['EDate'] . '</td>';
                            echo '<td>' . $data['FStatus'] . '</td>';
                            echo ' <td><button><a href="javascript:void()" onClick="chkalert()" ><i class="fa-solid fa-trash"></i></a></button></td>';
                            echo "</tr>";
                            $count++;
                        }
                        

                    ?>
                </tbody>
            </table>

        </div>
</section>

<?php
include_once("./includes/footer.php");
?>