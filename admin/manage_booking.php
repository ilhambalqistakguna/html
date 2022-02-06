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
  <a href="../index.php">HOME</a>

  <br>
  <b> Admin Dashboard</b>
  <a href="../login/logout.php">Logout</a>
  <br>
  
  <b>User</b>
  <a href="view_user.php">View</a>
  <a href="update_view_user.php">Update</a>
  <a href="search_user.php">Search</a>
  <br>
  <b>Car</b>
  <a href="add_product.php">Add</a>
  <a href="view_product.php">View</a>
  <a href="update_view_product.php">Update</a>
  <a href="search_product.php">Search</a>
  <br>
  <b>Booking</b>
  <a href="manage_booking.php">Booking</a>
  <br>
	
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
  <h3 align = "center" >Manage Booking</h3>
	<?php
		$query = "SELECT * FROM booking  WHERE usage_id ORDER BY user_name";
		$result = mysqli_query($dbconn, $query) or die ("Error: " . mysqli_error($dbconn));
		$numrow = mysqli_num_rows($result);
	?>
   <tr align="left" bgcolor="#DFEEEA">
    <td>
    <table width="80%" border="1" align="center" cellpadding="0" cellspacing="0">
      <tr align="center" bgcolor="#C5D7BD">
		<th width="3%">No</td>
        <th width="15%">Booking ID</th>   
        <th width= "15%">Name</th>
        <th width="15%">Car ID</th> 
        <th width="27%">Booking Date</th>              
        <th width="10%">Rent Date</th>
        <th width="10%">Return Date</th>
        <th>Status</th>

      </tr>
	  
      <?php
	  $color="1";
	  
	  for ($a=0; $a<$numrow; $a++) {
		$row = mysqli_fetch_array($result);
		
		if($color==1){
			echo "<tr bgcolor='#A7C4BC'>"
	  ?>
        <td>&nbsp;<?php echo $a+1; ?></td>
        <td>&nbsp;<?php echo $row['usage_id']; ?></td>
        <td>&nbsp; <?php echo $row['user_name']; ?> </td>
        <td>&nbsp; <?php echo $row ['car_no']; ?></td>
        <td>&nbsp; <?php echo $row ['date_made']; ?></td>
        <td><?php echo $row['usage_date']?></td>
        <td><?php echo $row['usage_rdate']?></td>
        <td><?php echo $row['status']?></td>
        <td>&nbsp; <?php
            include('../include/dbconn.php');
            $query = "SELECT * FROM booking WHERE usage_id ORDER BY user_name";
            $query_run = mysqli_query( $dbconn, $query);
            $row = mysqli_num_rows($query_run);
            echo $row;
        ?> </td>
       </tr> 
      <?php 
       $color="2";}
	   else{
	   echo "<tr bgcolor='#DFEEEA'>"
	  ?>
        <td>&nbsp;<?php echo $a+1; ?></td>
        <td>&nbsp;<?php echo $row['usage_id']; ?></td>
        <td>&nbsp; <?php echo $row['user_name']; ?> </td>
        <td>&nbsp; <?php echo $row ['car_no']; ?></td>
        <td>&nbsp; <?php echo $row ['date_made']; ?></td>
        <td><?php echo $row['usage_date']?></td>
        <td><?php echo $row['usage_rdate']?></td>
        <td><?php echo $row['status']?></td>
        <td>&nbsp; <?php
            include('../include/dbconn.php');
            $query = "SELECT * FROM booking WHERE usage_id ORDER BY user_name";
            $query_run = mysqli_query( $dbconn, $query);
            $row = mysqli_num_rows($query_run);
            echo $row;
        ?> </td>
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
