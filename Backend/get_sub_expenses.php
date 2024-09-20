<?php
// Check if the request is a POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the 'expenseType' parameter is set
    if (isset($_POST['expenseType'])) {
        // Simulate fetching sub expenses based on the selected 'Expense Type'
        $expenseType = $_POST['expenseType'];
        $subExpenses = [];

        // Populate $subExpenses based on the selected 'Expense Type'
        if ($expenseType == 'System') {
            $subExpenses = ['Purchase', 'Service'];
        } elseif ($expenseType == 'Office') {
            $subExpenses = ['Food', 'Stationary', 'Sanitary', 'Others'];
        } elseif ($expenseType == 'Travel'){
            $subExpenses = ['Demos','Others'];

        } elseif ($expenseType == 'Celebration'){
            $subExpenses = ['Birthday','Outing','Farewell','Others'];

        }

        // Return the sub expenses as JSON
        echo json_encode($subExpenses);
    } else {
        // Handle case when 'expenseType' parameter is not set
        echo "Error: 'expenseType' parameter is missing.";
    }
} else {
    // Handle case when the request is not a POST request
    echo "Error: Invalid request method.";
}
?>
