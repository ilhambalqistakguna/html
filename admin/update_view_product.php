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
  color: white;
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
  color: white;
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
  <a href="index.php">Home</a>
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
  <br>
  <h3>Car Available</h3>
	<?php
		$query = "SELECT * FROM car  WHERE status = '1' ORDER BY car_type";
		$result = mysqli_query($dbconn, $query) or die ("Error: " . mysqli_error($dbconn));
		$numrow = mysqli_num_rows($result);
	?>
   <tr align="left" bgcolor="#DFEEEA">
    <td>
    <table width="80%" border="1" align="center" cellpadding="0" cellspacing="0">
      <tr align="left" bgcolor="#C5D7BD">
    	<th width="3%">No</td>
        <th width="23%">Car Name</th>  
        <th width="23%">Car Description</th>     
        <th width="24%">Price per Day(RM)</th>
        <th align="center" colspan="2">Action</th>
      </tr>
	  
    <?php
	  $color="1";
	  
	  for ($a=0; $a<$numrow; $a++) {
		$row = mysqli_fetch_array($result);
		
		if($color==1){
			echo "<tr bgcolor='#A7C4BC'>"
	  ?>
        <td>&nbsp;<?php echo $a+1; ?></td>
        <td>&nbsp;<?php echo ucwords (strtolower($row['car_type'])); ?></td>  
        <td>&nbsp; <?php echo ucwords ($row['car_detail'])?></td>
        <td>&nbsp;<?php echo $row['rent_price']; ?></td>
        <td width="5%" align="center"><a class="one" href="update_product.php?id=<?php echo $row['car_no'];?>">Edit</a></td>
        <td width="5%" align="center"><a class="one" href="delete_product.php?id=<?php echo $row['car_no'];?>">Delete</a></td>
      </tr> 
      <?php 
       $color="2";}
	   else{
	   echo "<tr bgcolor='#CFEEEA'>"
	  ?>
        <td>&nbsp;<?php echo $a+1; ?></td>
        <td>&nbsp;<?php echo ucwords (strtolower($row['car_type'])); ?></td>  
        <td>&nbsp; <?php echo ucwords ($row['car_detail'])?></td>
        <td>&nbsp;<?php echo $row['rent_price']; ?></td>
        <td width="5%" align="center"><a class="one" href="update_product.php?id=<?php echo $row['car_no'];?>">Edit</a></td>
        <td width="5%" align="center"><a class="one" href="delete_product.php?id=<?php echo $row['car_no'];?>">Delete</a></td>
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

<br>
  <br>
  <br>
  <h3>Car Not Available</h3>
  <?php
		$query = "SELECT * FROM car  WHERE status = '2' ORDER BY car_type";
		$result = mysqli_query($dbconn, $query) or die ("Error: " . mysqli_error($dbconn));
		$numrow = mysqli_num_rows($result);
	?>

<tr align="left" bgcolor="#f2f2f2">
    <td>
    <table width="80%" border="1" align="center" cellpadding="0" cellspacing="0">
      <tr align="center" bgcolor="#f2f2f2">
 		<th width="3%">No</td>
        <th width="23%">Car Name</th>
        <th width="23%">Description</th>       
        <th width="24%">Price (RM)</th>
        <th align="center" colspan="2">Action</th>
  </tr>
	
      <?php
	  $color="1";
	  
	  for ($a=0; $a<$numrow; $a++) {
		$row = mysqli_fetch_array($result);
		
    if($color==1){
			echo "<tr bgcolor='#A7C4BC'>"
	  ?>
        <td>&nbsp;<?php echo $a+1; ?></td>
        <td><?php echo ucwords (strtolower($row['car_type'])); ?></td>
        <td><?php echo ucwords ($row['car_detail'])?></td>  
        <td><?php echo $row['rent_price']; ?></td>
        <td width="5%" align="center"><a class="one" href="update_product.php?id=<?php echo $row['car_no'];?>">Edit</a></td>
        <td width="5%" align="center"><a class="one" href="delete_product.php?id=<?php echo $row['car_no'];?>">Delete</a></td>
      </tr> 
      <?php 
       $color="2";}
	   else{
	   echo "<tr bgcolor='#CFEEEA'>"
	  ?>
<td>&nbsp;<?php echo $a+1; ?></td>
        <td>&nbsp;<?php echo ucwords (strtolower($row['car_type'])); ?></td>
        <td>&nbsp; <?php echo ucwords ($row['car_detail'])?></td>  
        <td>&nbsp;<?php echo $row['rent_price']; ?></td>
        <td width="5%" align="center"><a class="one" href="update_product.php?id=<?php echo $row['car_no'];?>">Edit</a></td>
        <td width="5%" align="center"><a class="one" href="delete_product.php?id=<?php echo $row['car_no'];?>">Delete</a></td>
      </tr>
	   <?php
	    $color="1";
	   }
	  } 
	  if ($numrow==0)
	  	{
		 echo '<tr>
    				<td colspan="8"><font color="#FF0000">No record available.</font></td>
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


























