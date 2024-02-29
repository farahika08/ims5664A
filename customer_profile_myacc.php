<?php
// Ensure session is started at the very beginning
session_start();

// Check if user is logged in (optional, based on your session management)
if (isset($_SESSION['customer_login']) && $_SESSION['customer_login'] == true) {
  $cust_id = $_SESSION['customer_Id'];
} else {
  // Handle the case where user is not logged in (e.g., redirect to login)
  echo "You are not logged in. Please log in to access your profile.";
  exit();
}

include 'db_connect.php';

// Check if customer_Id is set and perform the query (if necessary)
if (isset($cust_id)) {
  $sql = "SELECT * FROM bank_customers WHERE Customer_ID= '$cust_id' ";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
  $current_bal = $row ? $row['Current_Balance'] : 0; // Use a default value if no row found
} else {
  // Handle the case where customer_Id is not available
  echo "Error: Customer ID not found.";
  exit();
}

// Include header and other files after confirming login and potential errors
include 'header.php' ;
include 'customer_profile_header.php';

?>

<html>
<head>
  <title>My Account</title>
  <link rel="stylesheet" type="text/css" href="css/customer_profile_myacc.css" />
  <style>
    #customer_profile .link1 {
      background-color: rgba(5, 21, 71, 0.4);
    }
  </style>
</head>
<body>

<div class="cust_myacc_container">
  <br><br>
  <div class="accdet">
    <span class="heading">Account Details</span><br>
    <label>Customer Id : <?php echo isset($_SESSION['customer_Id']) ? $_SESSION['customer_Id'] : ""; ?></label><br>
    <label>Account Number : <?php echo isset($_SESSION['Account_No']) ? $_SESSION['Account_No'] : ""; ?></label><br>
    <label>Account Name : <?php echo isset($_SESSION['Username']) ? $_SESSION['Username'] : ""; ?></label><br>
    <label>Account Type : <?php echo isset($_SESSION['Account_type']) ? $_SESSION['Account_type'] : ""; ?></label><br>
    <label>IFSC Code : <?php echo isset($_SESSION['IFSC_Code']) ? $_SESSION['IFSC_Code'] : ""; ?></label><br>
    <label>Branch : <?php echo isset($_SESSION['Branch']) ? $_SESSION['Branch'] : ""; ?></label><br>

    <label>Available Balance :$<?php echo $current_bal; ?></label><br>
    <label>Mobile No : <?php echo isset($_SESSION['Mobile_no']) ? $_SESSION['Mobile_no'] : ""; ?></label><br>
    <label>Debit Card No : <?php echo isset($_SESSION['Debit_Card_No']) ? $_SESSION['Debit_Card_No'] : ""; ?></label><br>
    <label>Email Id : <?php echo isset($_SESSION['Email_ID']) ? $_SESSION['Email_ID'] : ""; ?></label><br><br><br><br>
    <a href="customer_pass_change.php"><input type="button" name="pass-chng" value="Change Password"></a>
  </div>
</div>

</body>
<?php include 'footer.php'; ?>
</html>