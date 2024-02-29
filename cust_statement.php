<?php
session_start(); // Start session at the beginning

include 'header.php';
?>

<head>
    <title>Statement</title>
    <link rel="stylesheet" type="text/css" href="css/cust_statement.css" />
    <style>
        #customer_profile .link5 {
            background-color: rgba(5, 21, 71, 0.4);
        }
    </style>
</head>

<body>

<?php
// Check if customer is logged in
if (isset($_SESSION['customer_login']) && $_SESSION['customer_login'] == true) {
    include 'customer_profile_header.php'; // Include profile header

    $cust_id = (isset($_SESSION['customer_Id'])) ? $_SESSION['customer_Id'] : null; // Check if customer_Id is set

    include 'db_connect.php'; // Include database connection

    // Ensure the table name is correct (replace with your actual table name if different)
    $sql = "SELECT * from passbook_$cust_id ORDER BY Id DESC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $Sl_no = 1;

        echo '<div class="cust_statement_container_head">';
        echo '<label class="heading">Bank Statement</label>';
        echo '</div>';

        echo '<div class="cust_statement_container">';
        echo '<div class="cust_statement">';

        echo '<table>';
        echo '<th>#</th>';
        echo '<th>Date</th>';
        echo '<th>Transaction Id</th>';
        echo '<th>Description</th>';
        echo '<th>Cr</th>';
        echo '<th>Dr</th>';
        echo '<th>Balance</th>';

        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $Sl_no++ . '</td>';
            echo '<td>' . $row['Transaction_date'] . '</td>';
            echo '<td>' . $row['Transaction_id'] . '</td>';
            echo '<td>' . $row['Description'] . '</td>';
            echo '<td>' . $row['Cr_amount'] . '</td>';
            echo '<td>' . $row['Dr_amount'] . '</td>';
            echo '<td>$' . $row['Net_Balance'] . '</td>';
            echo '</tr>';
        }

        echo '</table>';
        echo '</div>';
        echo '</div>';
    } else {
        echo "<div class='no_transactions'>No transactions found.</div>";
    }
} else {
    // Redirect to login page if not logged in
    header('location:customer_login.php');
}

include 'footer.php';
?>

</body>