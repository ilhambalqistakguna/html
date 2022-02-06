<?php
// Include database connection settings
include('../include/dbconn.php');

if(isset($_POST['signup'])){
	/* capture values from HTML form */
	$name = $_POST['user_name'];
	$address = $_POST['user_address'];
	$phoneno = $_POST['user_tel'];
	$email = $_POST['user_email'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$level = "user";

	$sql0 = "SELECT username FROM user WHERE username = '$username'";
	$query0 = mysqli_query($dbconn, $sql0) or die ("Error: " . mysqli_error($dbconn));
	$row0 = mysqli_num_rows($query0);
	
	if($row0 != 0){
	header('Location: ../signup/indexrecordexist.html');
	//echo "Record is existed";
	}
	else{
	/* execute SQL INSERT command */
	$sql2 = "INSERT INTO user (username, password,user_name,user_address,user_tel,user_email,level_id)
	VALUES ('" . $username . "', '" . $password . "', '" . $name . "', '" . $gender . "', '" . $address . "', '" . $phoneno . "', '" . $email . "', '" . $level_id . "')";
	
	mysqli_query($dbconn, $sql2) or die ("Error: " . mysqli_error($dbconn));
	/* rediredt to respective page */
	header('Location: ../index.html');
	//echo "Data has been saved";
	}
}// close if isset()
	/* close db connection */
	mysqli_close($dbconn);
?>
