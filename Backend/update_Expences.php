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

<div class="Expence-modal">
        <div class="Expence-form">
            <div class="close-modal">
                <i class="fa-solid fa-x"></i>
            </div>
            <h3>Create Expense</h3>
            <form action="" method="POST">

                <?php 
                    $fetchque = "Select * from `expences` where `UID` = '$sno'";
                    $fetchres = mysqli_query($con, $fetchque);
                    $row = mysqli_fetch_assoc($fetchres);
                ?>
                <div class="each-label">
                    <div class="each-label-sub">
                        <label for="DateEdit">Date:
                        </label>
                        <input type="date" name="DateEdit" id="DateEdit" value="<?=$row['Date']?>" required>
                    </div>
                    <div class="each-label-sub">
                        <label for="nameEdit">Person:</label>
                        <select name="nameEdit" id="nameEdit" required>
                            <?php
                            echo '<option value="'. $row['Person'] . '">' .$row['Person'] . '</option>';
                        ?>
                        </select>
                    </div>
                </div>
                <div class="each-label">
                    <!-- <div class="each-label-sub">
                        <label for="ExpenseTypeEdit">Expense Type:</label>
                        <select name="ExpenseTypeEdit" id="ExpenseTypeEdit" required>
                            <option value="" selected Disabled>Select</option>
                            <option value="System">System</option>
                            <option value="Office">Office</option>
                            <option value="Travel">Travel</option>
                            <option value="Celebration">Celebration</option>
                        </select>
                    </div> -->
                    <div class="each-label-sub">
                        <label for="AdvancePEdit">Advance Payment</label>
                        <input type="number" name="AdvancePEdit" id="AdvancePEdit" value="<?=$row['AdvPay']?>" required>
                    </div>
                    <div class="each-label-sub">
                        <label for="disc">Discription</label>
                        <!-- <input type="text"  name="disc" id="disc" required></select> -->
                        <textarea name="disc" id="disc" rows=5  style="border-radius=10px"; required><?= $row['EXPDiscription'] ?></textarea>
                    </div>

                </div>
                <!-- 
                <div class="each-label" id="subExpenseLabel" style="display: none;">
                    <div class="each-label-sub">
                        <label for="SubExpenseEdit">Sub Expense:</label>
                        <select name="SubExpenseEdit" id="SubExpenseEdit" required></select>
                    </div>
                </div>
                <div class="each-label" id="subExpenseTravel" style="display: none;">
                    <div class="each-label-sub">
                        <label for="SubExpenseTFEdit">From</label>
                        <input type="text">
                    </div>
                    <div class="each-label-sub">
                        <label for="SubExpenseTTEdit">To</label>
                        <input type="text">
                    </div>
                </div> -->
                <div class="each-label">

                    <div class="each-label-sub">
                        <label for="TCostEdit">Total Cost</label>
                        <input type="number" name="TCostEdit" id="TCostEdit" value="<?=$row['TPay']?>" required>
                    </div>
                    <div class="each-label-sub">
                        <label for="PCostEdit">Pending Amount</label>
                        <input type="number" name="PCostEdit" id="PCostEdit"  readonly>
                    </div>
                </div>
                <div class="each-label">
                    <div class="each-label-sub">
                        <label for="CommentEdit">Comment</label>
                        <textarea name="CommentEdit" id="CommentEdit" cols="10" rows="3" ><?=$row['Comment']?></textarea>
                    </div>

                    <div class="each-label-sub">
                        <label for="StatusEdit">Status</label>
                        <select name="StatusEdit" id="StatusEdit" required>
                            <option value="Rework">Rework</option>
                            <option value="Open">Open</option>
                            <?php
                                if($_SESSION['role'] == "Admin"){
                                    echo '<option value="Approved">Approved</option>';
                                    echo '<option value="Close">Close</option>';
                                }
                            ?>
                        </select>
                    </div>
                </div>

                <input type="submit" value="Update">

            </form>

        </div>
    </div>

    <?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $date = mysqli_real_escape_string($con,$_POST['DateEdit']);
    $person = mysqli_real_escape_string($con,$_POST['nameEdit']);
    // $Etype = mysqli_real_escape_string($con,$_POST['ExpenseTypeEdit']);
    // $ESubtype = mysqli_real_escape_string($con,$_POST['SubExpense']);
    $AdvPay = mysqli_real_escape_string($con,$_POST['AdvancePEdit']);
    $Tpay = mysqli_real_escape_string($con,$_POST['TCostEdit']);
    $PenPay = mysqli_real_escape_string($con,$_POST['PCostEdit']);
    $Status = mysqli_real_escape_string($con,$_POST['StatusEdit']);
    $cmt = mysqli_real_escape_string($con,$_POST['CommentEdit']);

    // $date = $_POST['DateEdit'];
    // $person = $_POST['nameEdit'];
    // $Etype = mysqli_real_escape_string($con,$_POST['ExpenseTypeEdit']);
    // $ESubtype = mysqli_real_escape_string($con,$_POST['SubExpense']);
    // $AdvPay = $_POST['AdvancePEdit'];
    // $Tpay = $_POST['TCostEdit'];
    // $PenPay = $_POST['PCostEdit'];
    // $Status = $_POST['StatusEdit'];
    // $cmt = $_POST['CommentEdit'];

    $updQue = "UPDATE `expences` SET `Date` = '$date', `AdvPay` = '$AdvPay',`TPay` = '$Tpay', `PenAmt` = '$PenPay',`Status` = '$Status',`Comment`='$cmt' WHERE `expences`.`UID` = $sno";
    $updQueRes = mysqli_query($con,$updQue);

    if($updQueRes){
        echo "<script>alert('Successfully Updated Expences.'); window.location.href = 'Expences.php';</script>";
        exit();
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
        window.location.href = "Expences.php";
    });
});

</script>

<script>
    // Get the input elements
    const advancePaymentInput = document.getElementById('AdvancePEdit');
    const totalCostInput = document.getElementById('TCostEdit');
    const pendingAmountInput = document.getElementById('PCostEdit');

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