<?php 
// Include database connection settings
include('../include/dbconn.php');
include ("../login/session.php");
session_start();
$user = $_SESSION['username'];
if (!isset($_SESSION['username'])) {
        header('Location: ../login');
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
  background-image:url('');
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
<br><br>
  <a href="../index.php">HOME</a>

  <br>
  <b> Admin Dashboard</b>
  <a href="../login/logout.php">Logout</a>
  <br>
  
  <b>User</b>
  <a href="view_user.php">View</a>
  <a href="update_view_user.php">Update</a>
  <a href="search_user.php">Search</a>
  
  <b>Car</b>
  <a href="add_product.php">Add</a>
  <a href="view_product.php">View</a>
  <a href="update_view_product.php">Update</a>
  <a href="search_product.php">Search</a>
  
  <b>Booking</b>
  <a href="add_order.php">Add</a>
  <a href="view_order.php">View</a>
  <a href="update_view_order.php">Update</a>
  <a href="search_order.php">Search</a>
	
  <b>Report</b>
  <a href="report_user.php">User Report</a>
  <a href="report_car.php">Car Report</a>
</div>

<div class="main">
  <div class="greatinguser">
	<h1><?php echo $user; ?></h1>
	<h3>Car Rental Administrator Dashboard</h3>
  </div> 
</div>

<div class="container">

<h3>Update Admin Data</h3>

<?php
	$query = "SELECT * FROM user WHERE username='$user'";
	$result = mysqli_query($dbconn, $query) or die ("Error: " . mysqli_error($dbconn));
	$row = mysqli_fetch_array($result);
?>

<fieldset>

<form name="edit_user" method="post" action="db_update_admin.php" enctype="multipart/form-data">
    <table width="80%" border="0" align="center">
      <tr>
        <td width="16%">Name</td>  
        <td width="84%"><input type="text" name="name" size="50" value="<?php echo ucwords (strtolower($row['user_name'])); ?>" />
      </tr>  
	  <tr>
        <td width="16%">Email</td>
        <td><input type="text" name="email" size="50" value="<?php echo $row['user_email']; ?>"/></td>
      </tr>
	  <tr>
        <td width="16%">Phone No</td>
        <td><input type="text" name="phone" size="50" value="<?php echo $row['user_tel']; ?>"/></td>
      </tr>
      <tr>
        <td width="16%">Address</td>
        <td><textarea name="address" cols="47" rows="3"><?php echo ucwords (strtolower($row['user_address'])); ?></textarea></td>
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
        <td colspan="2"><input type="hidden" name="user" value=" <?php echo $user; ?> " />
        <input type="hidden" name="pic" value="<?php echo $row['picture'];?>" /></td>
      </tr>
	  
      <tr> 
        <td colspan="2"><input type="submit" name="submit" value=" Save " />
        <input type="button" name="cancel" value=" Cancel " onclick="location.href='update_view_user.php'" /></td>
      </tr>
    </table>
</form>

</fieldset>
 
</div>
   
</body>

</html> 


























