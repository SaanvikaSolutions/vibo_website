<?php
session_start();

// Include connection and navbar files (assuming they exist)
include("./connections/dbconnect.php");
include("./includes/navbar.php");

// Redirect to login if not logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Initialize session variable (improved for clarity)
if (!isset($_SESSION['selectedOption'])) {
    $_SESSION['selectedOption'] = "";
}

?>

<section id="allWork">

<div class="up-W-F">
  <form action="" method="post">
    <input type="hidden" name="selected_option" id="selected_option" value="">
    <div class="each-label">
      <label for="option">Select an option:</label>
      <select name="option" id="option">

          <option value="">ALL</option>
        <?php
        // Improved query to avoid SQL injection vulnerability
        $selQ = "SELECT Username FROM user WHERE Role != 'Admin'";
        $selRes = mysqli_query($con, $selQ);  // Prepared statements would be even better
        while ($row = mysqli_fetch_assoc($selRes)) {
          echo '<option value="' . $row['Username'] . '">' . $row['Username'] . '</option>';
        }
        ?>
      </select>

      <button type="submit">Search</button>
    </div>
  </form>
</div>


<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $_SESSION['selectedOption'] = $_POST['selected_option'];
} 
?>
<?= $_SESSION['selectedOption'] ?>
<table id="myTable" class="AE-table-s">
  <thead>
    <tr>
      <th>Employee Name</th>
      <th>Project Name</th>
      <th>Work Done</th>
      <th>Date</th>
    </tr>
  </thead>
  <tbody>
    <?php

    if (!empty($_SESSION['selectedOption'])) {
      // Display filtered data if option is selected

      $sql = "SELECT * FROM work WHERE EName = '" . $_SESSION['selectedOption'] . "' ORDER BY Date DESC";
        $sqlRes = mysqli_query($con,$sql);

      while ($row = mysqli_fetch_assoc($sqlRes)) {
        echo '<tr>';
        echo '<td>' . $row['EName'] . '</td>';
        echo '<td>' . $row['PName'] . '</td>';
        echo '<td>' . $row['WorkDisc'] . '</td>';
        echo '<td>' . $row['Date'] . '</td>';
        echo '</tr>';
      }
    } else {
      // Display all data if no option is selected
      $showquery = "SELECT * FROM `work` ORDER BY Date DESC";
    $showRes = mysqli_query($con, $showquery);
      while ($row = mysqli_fetch_assoc($showRes)) {
        echo '<tr>';
        echo '<td>' . $row['EName'] . '</td>';
        echo '<td>' . $row['PName'] . '</td>';
        echo '<td>' . $row['WorkDisc'] . '</td>';
        echo '<td>' . $row['Date'] . '</td>';
        echo '</tr>';
      }
    }

    ?>
  </tbody>
</table>
</section>


<script>
  document.getElementById('option').addEventListener('change', function() {
    var selectedOption = this.value;
    document.getElementById('selected_option').value = selectedOption;
  });
</script>

<script>
  $(document).ready(function () {
    $('#myTable').DataTable();
  });
</script>

<?php
include_once("./includes/footer.php");
?>
