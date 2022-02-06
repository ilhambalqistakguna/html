<?php 
// Include database connection settings
include('../include/dbconn.php');

include ("../login/session.php");
session_start();

if (!isset($_SESSION['username'])) {
        header('Location: ../login');
		} 
		
?>
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
  max-width: 500px;
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
  <a href="add_order_product.php">Add</a>
  <a href="view_order.php">View</a>
	
</div>

<div class="main">
  <h2>Car Rental</h2>
  <p>&nbsp;</p>
</div>

<div class="main">
<h3> <?php echo $_SESSION['username'];?> Personal Data</h3>

<?php
  $user_name = $_SESSION['username'];
	$query = "SELECT * FROM user WHERE level_id = 2 ORDER BY username ";
	$result = mysqli_query($dbconn, $query) or die ("Error: " . mysqli_error($dbconn));
	$numrow = mysqli_num_rows($result);

?>
   <tr align="left" bgcolor="#f2f2f2">
    <td>
    <table width="100%" border="1" align="center" cellpadding="0" cellspacing="0">
      <tr align="left" bgcolor="#f2f2f2">
        <th width="3%">No</td>
        <th width="26%">Name</td>       
        <th width="8%">Email</td>
        <th width="27%">Address</td>
        <th width="9%">Telephone</td>
        <th width="8%">Level</td>
      </tr>
	  
      <?php
	  $color="1";
	  
	  for ($a=0; $a<$numrow; $a++) {
		$row = mysqli_fetch_array($result);
		
		if($color==1){
echo "<tr bgcolor='#FFFFCC'>"
	  
      ?>
        <td>&nbsp;<?php echo $a+1; ?></td>
        <td>&nbsp;<?php echo ucwords (strtolower($row['user_name'])); ?></td>
        <td><?php echo ucwords($row['user_email']);?></td>   
        <td><?php echo ucwords (strtolower($row['user_address'])); ?></td>
        <td>&nbsp;<?php echo $row['user_tel']; ?></td>
        <td>&nbsp;<?php echo $row['level_id']; ?></td>
      </tr> 
      <?php 
       $color="2";}
	   else{
	   echo "<tr bgcolor='#FFCC99'>"
	  
      ?>
        <td>&nbsp;<?php echo $a+1; ?></td>
        <td>&nbsp;<?php echo ucwords (strtolower($row['user_name'])); ?></td>   
        <td><?php echo ucwords (strtolower($row['user_address'])); ?></td>
        <td>&nbsp;<?php echo $row['user_tel']; ?></td>
        <td>&nbsp;<?php echo $row['level_id']; ?></td>
      </tr>
	   <?php
	    $color="1";
	   }
	  } 
	  if ($numrow==0)
	  	{
		 echo '<tr>
    				<td colspan="8"><font color="#FF0000">No record avaiable.</font></td>
 			   </tr>'; 
		}
	  ?>
    </table>
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>



   
   
</div>
   
</body>
</html> 


























