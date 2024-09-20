<?php
session_start(); 
include("./connections/dbconnect.php");
include("./includes/navbar.php");

if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit();
}

// Define variables to store validation error messages
$errors = array('username' => '','email' => '', 'password' => '', 'confirm_password' => '');

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $date = mysqli_real_escape_string($con,$_POST['Date']);
    $person = mysqli_real_escape_string($con,$_POST['name']);
    $Etype = mysqli_real_escape_string($con,$_POST['ExpenseType']);
    $ESubtype = mysqli_real_escape_string($con,$_POST['SubExpense']);
    $disc = mysqli_real_escape_string($con,$_POST['disc']);
    if(empty($_POST['SubExpenseTF'])){
        $FromLoc = "N.A";
    }else{
        $FromLoc = mysqli_real_escape_string($con,$_POST['SubExpenseTF']);
    }
    if(empty($_POST['SubExpenseTT'])){
        $ToLoc = "N.A";
    }else{
        $ToLoc = mysqli_real_escape_string($con,$_POST['SubExpenseTT']);
    }
    $AdvPay = mysqli_real_escape_string($con,$_POST['AdvanceP']);
    $Tpay = mysqli_real_escape_string($con,$_POST['TCost']);
    $PenPay = mysqli_real_escape_string($con,$_POST['PCost']);
    $Status = mysqli_real_escape_string($con,$_POST['Status']);

    $expQuery = "INSERT INTO `expences` (`Date`, `Person`, `EXPDiscription` , `EType`, `ESubType`, `FromLoc`, `ToLoc`, `AdvPay`, `TPay`, `PenAmt`, `Status`) VALUES ('$date', '$person','$disc', '$Etype', '$ESubtype', '$FromLoc', '$ToLoc', '$AdvPay', '$Tpay', '$PenPay', '$Status')";
    $expRes = mysqli_query($con,$expQuery);

    if($expRes){
        echo "<script>alert('Successfully Created Expence.'); window.location.href = 'Expences.php';</script>";
        exit();
        
    }else{
        echo "Error: " . mysqli_error();
    }

}


?>

<section id="Expences" class="AE-S">


    <?php 
    if($_SESSION['role'] == "Admin") {?>

    <div class="AE-sumery-s">
        <div class="parts">
            <div class="parts-head">
                <h1>Total Expences</h1>
            </div>
            <div class="parts-b">
                <p>₹
                    <?php 
                        $totalAmt = "Select sum(TPay) AS totalAmount from `expences`";
                        $totalAmtres = mysqli_query($con,$totalAmt);
                        
                        if ($totalAmtres) {
                            // Fetch the result as an associative array
                            $totalAmtRow = mysqli_fetch_assoc($totalAmtres);
                        
                            // Check if the sum is not null
                            if ($totalAmtRow['totalAmount'] !== null) {
                                // Echo the total amount
                                echo $totalAmtRow['totalAmount'];
                            } else {
                                echo "Total amount not available.";
                            }
                        } else {
                            echo "Error executing the query: " . mysqli_error($con);
                        }
                    ?>
                </p>
            </div>
        </div>
        <div class="parts">
            <div class="parts-head">
                <h1>Total No of Expences</h1>
            </div>
            <div class="parts-b">
                <p>
                    <?php 
                        $currentMonth = date('m');
                        $currentYear = date('Y');
                        
                        // Query to select the count of payments for the current month
                        $totalNumQuery = "SELECT COUNT(TPay) AS totalpay FROM expences WHERE MONTH(Date) = $currentMonth AND YEAR(Date) = $currentYear";
                        $totalExpNumres = mysqli_query($con,$totalNumQuery);
                        
                        if ($totalExpNumres) {
                            // Fetch the result as an associative array
                            $totalAmtRow = mysqli_fetch_assoc($totalExpNumres);
                        
                            // Check if the sum is not null
                            if ($totalAmtRow['totalpay'] !== null) {
                                // Echo the total amount
                                echo $totalAmtRow['totalpay'];
                            } else {
                                echo "Total amount not available.";
                            }
                        } else {
                            echo "Error executing the query: " . mysqli_error($con);
                        }
                    ?>
                </p>
            </div>
        </div>
        <div class="parts">
            <div class="parts-head">
                <h1><i class="fa-solid fa-circle" style="color: green;"></i> Paid Amount</h1>
            </div>
            <div class="parts-b">
                <p>₹
                    <?php 
                        $AdvAmt = "Select sum(AdvPay) AS AdvAmount from `expences`";
                        $totalAmtres = mysqli_query($con,$AdvAmt);
                        
                        if ($totalAmtres) {
                            // Fetch the result as an associative array
                            $totalAmtRow = mysqli_fetch_assoc($totalAmtres);
                        
                            // Check if the sum is not null
                            if ($totalAmtRow['AdvAmount'] !== null) {
                                // Echo the total amount
                                echo $totalAmtRow['AdvAmount'];
                            } else {
                                echo "Total amount not available.";
                            }
                        } else {
                            echo "Error executing the query: " . mysqli_error($con);
                        }
                    ?>
                </p>
            </div>
        </div>
        <div class="parts">
            <div class="parts-head">
                <h1><i class="fa-solid fa-circle" style="color: red;"></i> Amount To Be Paid</h1>
            </div>
            <div class="parts-b">
                <p>₹
                    <?php 
                        $PenAmt = "Select sum(PenAmt) AS PenAmount from `expences`";
                        $totalAmtres = mysqli_query($con,$PenAmt);
                        
                        if ($totalAmtres) {
                            // Fetch the result as an associative array
                            $totalAmtRow = mysqli_fetch_assoc($totalAmtres);
                        
                            // Check if the sum is not null
                            if ($totalAmtRow['PenAmount'] !== null) {
                                // Echo the total amount
                                echo $totalAmtRow['PenAmount'];
                            } else {
                                echo "Total amount not available.";
                            }
                        } else {
                            echo "Error executing the query: " . mysqli_error($con);
                        }
                    ?>
                </p>
            </div>
        </div>
    </div>

    <?php } ?>

    <?php if($_SESSION['role']  != 'Admin'){ ?>
        <div class="expence_form">
        <h1>Create Expences</h1>
        <form action="" method="post">

            <div class="each-label">
                <div class="each-label-sub">
                    <label for="Date">Date:
                    </label>
                    <input type="date" name="Date" id="Date"
                        min="<?php echo date('Y-m-d', strtotime('-4 days', strtotime(date('y-m-d')))); ?>" required>
                </div>
                <div class="each-label-sub">
                    <label for="name">Person:</label>
                    <select name="name" id="name" required>
                        <?php
                            echo '<option value="'. $_SESSION['username'] . '">' .$_SESSION['username'] . '</option>';
                        ?>
                    </select>
                </div>
            </div>
            <div class="each-label">
                <div class="each-label-sub">
                    <label for="disc">Discription</label>
                    <!-- <input type="text"  name="disc" id="disc" required></select> -->
                    <textarea name="disc" id="disc" rows=5 placeholder="Enter about the product" style="border-radius=10px"; required></textarea>
                </div>

            </div>
            <div class="each-label">
                <div class="each-label-sub">
                    <label for="ExpenseType">Expense Type:</label>
                    <select name="ExpenseType" id="ExpenseType" required>
                        <option value="" selected Disabled>Select</option>
                        <option value="System">System</option>
                        <option value="Office">Office</option>
                        <option value="Travel">Travel</option>
                        <option value="Celebration">Celebration</option>
                    </select>
                </div>
                <div class="each-label-sub">
                    <label for="AdvanceP">Advance Payment</label>
                    <input type="number" name="AdvanceP" id="AdvanceP" value="0" required>
                </div>

            </div>
           
            <div class="each-label" id="subExpenseLabel" style="display: none;">
                <div class="each-label-sub">
                    <label for="SubExpense">Sub Expense:</label>
                    <select name="SubExpense" id="SubExpense" required></select>
                </div>
                

            </div>
            <div class="each-label" id="subExpenseTravel" style="display: none;">
                <div class="each-label-sub">
                    <label for="SubExpenseTF">From</label>
                    <input type="text">
                </div>
                <div class="each-label-sub">
                    <label for="SubExpenseTT">To</label>
                    <input type="text">
                </div>
            </div>
            <div class="each-label">

                <div class="each-label-sub">
                    <label for="TCost">Total Cost</label>
                    <input type="number" name="TCost" id="TCost" required>
                </div>
                <div class="each-label-sub">
                    <label for="PCost">Pending Amount</label>
                    <input type="number" name="PCost" id="PCost" readonly required>
                </div>
            </div>
            <div class="each-label">

                <div class="each-label-sub">
                    <label for="Status">Status</label>
                    <select name="Status" id="Status" required>
                        <option value="Open">Open</option>
                    </select>
                </div>
            </div>

            <input type="submit" value="submit">

        </form>


    </div>

    <?php } ?>

    <div class="AE-mid-s">
        <div class="AE-Heading">
            <h2 class="AE-Heading">Expenses:</h2>
        </div>
        <div class="AE-Create">
            <button class="AE-create-button"><i class="fa-solid fa-plus"></i> Create Expenses</button>
        </div>
    </div>
    <div class="tabel-container">
        <table id="myTable" class="AE-table-s">
            <thead>
                <tr>
                    <th>Expenses Id</th>
                    <th>Date</th>
                    <th>Created By</th>
                    <th>Discription</th>
                    <th>Expenses For</th>
                    <th>Pending Amount</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                        $showquery = "SELECT * FROM `expences` WHERE `Person` = '{$_SESSION['username']}'";
                        $showRes = mysqli_query($con,$showquery);

                        if($_SESSION['role'] == "Admin"){
                            $showquery = "SELECT * FROM `expences`";
                            $showRes = mysqli_query($con,$showquery);

                        }

                        $bgColor = 'grey';
                        $numberofrows = mysqli_num_rows($showRes);
                        if ($numberofrows > 0) {

                            
                            // Fetch rows one by one using a while loop
                            while ($row = mysqli_fetch_assoc($showRes)) {
                                if( $row['Status'] === 'Open'){
                                    $bgColor = 'white';
        
                                }
                                if( $row['Status'] === 'Rework'){
                                    $bgColor = '#FFC0C0';
        
                                }
                                if( $row['Status'] === 'Approved'){
                                    $bgColor = '#C2F1C1';
        
                                }
                                if( $row['Status'] === 'Close'){
                                    $bgColor = '#C6D5DB';
        
                                }
                                echo '<tr style="background-color: ' . $bgColor . ';">'; // Assuming you're echoing within a table row
                                echo '<td>' . $row['UID'] . '</td>';
                                echo '<td>' . $row['Date'] . '</td>';
                                echo '<td>' . $row['Person'] . '</td>';
                                echo '<td>' . $row['EXPDiscription'] . '</td>';
                                echo '<td>' . $row['ESubType'] . '</td>';
                                echo '<td>' . $row['PenAmt'] . '</td>';
                                echo '<td>' . $row['Status'] . '</td>';
                                if($row['Status'] != 'Close'){
                                    echo '<td><button><a href="update_Expences.php?Sno=' . $row['UID'] . '"><i class="fa-solid fa-pen-to-square"></i></a></button>';
                                }else{
                                    echo '<td>';
                                }
                                echo ' <button><a href="javascript:void()" onClick="chkalert('.$row['UID'].')" ><i class="fa-solid fa-trash"></i></a></button></td>';
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
    $select_query = "DELETE FROM `expences` WHERE `UID` = $id";
    $result_query = mysqli_query($con, $select_query);

    if ($result_query) {
        echo "<script>alert('Deleted successfully'); window.location.href = 'Expences.php';</script>";
            exit();

    }
    else {
        echo "<script>alert('Error deleting record'); window.location.href = 'Expences.php';</script>";
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
                document.location.href=`Expences.php?delete_id=${id}`
            }
        }
</script>

<script>
    // Accessing the elements
    let ExpMod = document.querySelector(".Expence-modal");
    let ModalVis = document.querySelector(".AE-create-button");
    let clMod = document.querySelector(".close-modal i");

    // Adding event listener
    ModalVis.addEventListener("click", () => {
        ExpMod.classList.toggle("Expence-modal-visible");
    });
    clMod.addEventListener("click", () => {
        ExpMod.classList.remove("Expence-modal-visible");
    });
</script>

<script>
    document.getElementById('ExpenseType').addEventListener('change', function () {
        var expenseType = this.value;
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'get_sub_expenses.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                var subExpenses = JSON.parse(xhr.responseText);
                var subExpenseSelect = document.getElementById('SubExpense');
                subExpenseSelect.innerHTML = ''; // Clear previous options
                subExpenses.forEach(function (subExp) {
                    var option = document.createElement('option');
                    option.value = subExp;
                    option.textContent = subExp;
                    subExpenseSelect.appendChild(option);
                });
                document.getElementById('subExpenseLabel').style.display = 'flex';
                if (expenseType == "Travel") {
                    document.getElementById('subExpenseTravel').style.display = 'flex';

                }
            }
        };
        xhr.send('expenseType=' + encodeURIComponent(expenseType));
    });

    document.getElementById('expenseForm').addEventListener('submit', function (event) {
        event.preventDefault(); // Prevent default form submission
        var formData = new FormData(this);
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'process_form.php', true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                alert(xhr.responseText); // Display response message
            }
        };
        xhr.send(formData);
    });
</script>

<script>
    // Get the input elements
    const advancePaymentInput = document.getElementById('AdvanceP');
    const totalCostInput = document.getElementById('TCost');
    const pendingAmountInput = document.getElementById('PCost');

    // Function to calculate and update pending amount
    function updatePendingAmount() {
        const advancePayment = parseFloat(advancePaymentInput.value);
        const totalCost = parseFloat(totalCostInput.value);
        const pendingAmount = totalCost - advancePayment;

        // Update the pending amount input value
        pendingAmountInput.value = isNaN(pendingAmount) ? '' : pendingAmount.toFixed(2);
    }

    // Attach event listeners to update pending amount when Advance Payment or Total Cost changes
    advancePaymentInput.addEventListener('input', updatePendingAmount);
    totalCostInput.addEventListener('input', updatePendingAmount);

    // Initial calculation on page load (if values are pre-filled)
    updatePendingAmount();
</script>


<?php
include_once("./includes/footer.php");
?>