<?php
// Ensure session is started at the very beginning
session_start();

// Check if user is logged in (optional, based on your session management)
if (!isset($_SESSION['customer_login']) || $_SESSION['customer_login'] != true) {
  header('location:customer_login.php');
  exit(); // Prevent further code execution after redirect
}

include 'db_connect.php';

// Check if customer_Id is set and handle potential errors
if (isset($_SESSION['customer_Id'])) {
  $customer_id = $_SESSION['customer_Id'];
} else {
  echo "Error: Customer ID not found.";
  exit();
}

?>

<html>
<head>
  <title>Change Password</title>
  <link rel="stylesheet" type="text/css" href="css/customer_pass_change.css"/>
  <style>
    #customer_profile .link3 {
      background-color: rgba(5, 21, 71, 0.4);
    }
  </style>

</head>
<body>

<?php
// Include header and other files after login confirmation and error handling
include 'header.php';
include 'customer_profile_header.php';

if (isset($_POST['change_pass'])) {

  $oldpass = $_POST['oldpass'];
  $cnfrm = $_POST['cnfrm'];
  $newpass = $_POST['newpass'];
include 'db_connect.php';
	$customer_id=$_SESSION['customer_Id'];
	
		$sql="SELECT Password from bank_customers WHERE Customer_ID='$customer_id' ";
		if(!$result=$conn->query($sql)){
			
			echo "Error:1 " . $sql . "<br>" . $conn->error;
		}
		
		$row = $result->fetch_assoc();
	
	if($oldpass == $cnfrm){
	
	if($row['Password'] == $oldpass ){
		
		$sql2="UPDATE bank_customers SET  Password='$newpass' WHERE bank_customers.Customer_ID=$customer_id ";
		$conn->query($sql2);
		if($result=$conn->query($sql2)== TRUE){
			
				
				echo '<script>alert("Password Changed Successfully!")</script>';
			
		}
		
	}
	
	else
		{	
		if($row['Password'] != $oldpass ){
			echo '<script>alert("Please enter correct old password")</script>'; 
			
		}
		
		}
			
		}	

			
		else
			
			{	
			
			if($oldpass != $cnfrm){
				
				echo '<script>alert("Two errors\n1. Old password and Confirm Password is different!\n2. Old password is wrong")</script>';
					
					}
				
				else{

				echo '<script>alert("Old password and Confirm Password is different!")</script>';
				
				}

				
			}
  // ... rest of your code for password change logic ...

}
?>

<div class="cust_passchng_container">
  <form method="post">
    <br><br>
    <input type="password" name="oldpass" placeholder="Old Password" required><br>
    <input type="password" name="cnfrm" placeholder="Confirm old Password" required><br>
    <input type="password" name="newpass" placeholder="New Password" required><br>
    <input type="submit" name="change_pass" placeholder="Old Password"><br><br>
  </form>

</div>

<?php include 'footer.php'; ?>
</body>
</html>