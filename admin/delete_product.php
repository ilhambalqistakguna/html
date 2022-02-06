<?php
	include('../include/dbconn.php');
	
	$car_no=$_GET['car_no'];
	
	$delete = "DELETE FROM car WHERE car_no='$car_no'";
	$result = mysqli_query($dbconn, $delete) or die ("Error: " . mysqli_error($dbconn));
	//echo $delete;
	
	if ($result) {
	  ?>
	  <script type="text/javascript">
	  	window.location = "view_product.php"
	  </script>
	  <?php }
    
    else
    {
      echo $update;
	?> 
	  <script type="text/javascript">
	  	window.location = "view_product.php"
	  </script>
	<?php       
     } 
	
?>