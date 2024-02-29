<?php
  // Ensure session is started at the very beginning
  session_start();

  // Check if customer_Id is set in the session
  if (isset($_SESSION['customer_Id'])) {
    $customer_id = $_SESSION['customer_Id'];
  } else {
    // Handle the case where customer_Id is not set (e.g., redirect to login page)
    echo "You are not logged in. Please log in to access your profile.";
    // Exit the script or redirect to login page
    exit();
  }

  include 'db_connect.php';
  $sql = "SELECT * FROM bank_customers WHERE Customer_ID= '$customer_id' ";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
?>

<html>
  <head>
    <title>My Profile</title>
    <link rel="stylesheet" type="text/css" href="css/customer_profile_myprofile.css">
    <style>
      #customer_profile .link2 {
        background-color: rgba(5, 21, 71, 0.4);
      }
    </style>
  </head>
  <body>
    <?php include 'header.php';
      include 'customer_profile_header.php'; ?>

    <div class="myprofile_container">
      <div class="customer_profile_photo">
        </div>
      <div class="customer_profile_details">
        <?php
          if ($row) {
            echo '<label>Name : ' . $row['Username'] . ' </label><br>';
            echo '<label>Sex : ' . $row['Gender'] . ' </label><br>';
            echo '<label>Mobile No : ' . $row['Mobile_no'] . ' </label><br>';
            echo '<label>Addresss : ' . $row['Home_Addr'] . ' </label><br>';
            echo '<label>Country : ' . $row['Country'] . ' </label><br>';
            echo '<label>Currency : MYR </label><br>';
            echo '<label>State : ' . $row['State'] . ' </label><br>';
            echo '<label>Code : ' . $row['Pin_code'] . ' </label><br>';
            echo '<label>Account Opening Date : ' . $row['Ac_Opening_Date'] . ' </label><br>';
            // ... display other details ...
            
          } else {
            echo "No data found for this customer.";
          }
        ?>
      </div>
    </div>

    <?php include 'footer.php'; ?>
  </body>
</html>