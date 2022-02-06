<?php 
// Include database connection settings
include('../include/dbconn.php');
include ("../login/session.php");
session_start();
$user = $_SESSION['username'];
if (!isset($_SESSION['username'])) {
        header('Location: ../login');
		} 
// Include database connection file
if(count($_POST)>0) {
mysqli_query($dbconn,"UPDATE user set  user_name='" . $_POST['user_name'] . "', user_tel='" . $_POST['user_tel'] . "' , user_email='" . $_POST['user_email'] . "', user_address='" . $_POST['user_address'] . "' WHERE username='" . $_POST['username'] . "'");

}
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  font-family: "Lato", sans-serif;
  color: #367588;
  background-image:url('../images/background_ssc.png');
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: cover;
  background-color: #ffffff;
}

div {
  max-width: 1100px;
  height: 100px;
}

.sidenav {
  height: 100%;
  width: 200px;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: #000000;
  overflow-x: hidden;
  padding-top: 20px;
}

.sidenav a {
  padding: 6px 6px 6px 6px;
  text-decoration: none;
  font-size: 14px;
  color: #818181;
  display: block;
}

.sidenav a:hover {
  color: #f1f1f1;
}

.greatinguser{
  text-transform: uppercase;
}

.main {
  margin-left: 200px; /* Same as the width of the sidenav */
}

.container{
  font-family: "Lato", sans-serif;
  color: #000000;
  margin-left: 200px;
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}


</style>
</head>
<body>

<div class="sidenav">
  <a href="../index.php">HOME</a>
  <br>
  <b> Customer Dashboard</b>
  <a href="../login/logout.php">Logout</a>
  <br>
  
  <b>User</b>
  <a href="viewuser.php">View</a>
  <a href="update_user.php">Update</a>
  
  <b>Car</b>
  <a href="view_product.php">View</a>
  <a href="search_product.php">Search</a>
  
  <b>Booking</b>
  <a href="add_order.php">Add</a>
  <a href="view_order.php">View</a>
	
</div>

<div class="main">
  <div class="greatinguser">
	<h1><?php echo $user; ?></h1>
	<h3>Car Rental Customer Dashboard</h3>
  </div> 
</div>

<div class="container">

<h3>Update User Data</h3>

<?php
	$query = "SELECT * FROM user WHERE username='$user'";
	$result = mysqli_query($dbconn, $query) or die ("Error: " . mysqli_error($dbconn));
	$row = mysqli_fetch_array($result);
?>

<fieldset>

<form name="edit_user" method="post" action="" enctype="multipart/form-data">
    <table width="80%" border="0" align="center">
      <tr>
        <td width="16%">Name</td>  
        <td width="84%"><input type="text" name="user_name" size="50" value="<?php echo ucwords (strtolower($row['user_name'])); ?>" /></td>  
      </tr>  
	  <tr>
        <td width="16%">Email</td>
        <td><input type="text" name="user_email" size="50" value="<?php echo $row['user_email']; ?>"/></td>
      </tr>
	  <tr>
        <td width="16%">Phone No</td>
        <td><input type="text" name="user_tel" size="50" value="<?php echo $row['user_tel']; ?>"/></td>
      </tr>
      <tr>
        <td width="16%">Address</td>
        <td><textarea name="user_address" cols="47" rows="3"><?php echo ucwords (strtolower($row['user_address'])); ?></textarea></td>
      </tr>
      <tr>
        <td width="16%">Username</td>
        <td><?php echo $row['username']; ?>
        	<input type="hidden" name="username" size="50" value="<?php echo $row['username']; ?>" /></td> 
      </tr>
      <tr>
        <td width="16%">Password</td>
        <td><input type="password" name="password" size="50" value="<?php echo $row['password']; ?>" /></td> 
      </tr>
	  <tr>
      	<td>Picture</td>
        <td>
          <input type="file" name="file" id="file" />
          <img src="../images/<?php echo $row['picture'];?>" width="130" height="130">
	    </td>
      </tr>  
      <tr> 
        <td colspan="2"><input type="submit" name="submit" value=" Save " />
        <input type="button" name="cancel" value=" Cancel " onclick="location.href='viewuser.php'" /></td>
        <!--dia akan bawa ke page view user sebab user cancel-->
      </tr>
	  
    </table>
</form>

</fieldset>
 
</div>

</body>

</html> 
