<?php
include('../include/dbconn.php');

$i=0;

foreach ( $_POST as $sForm => $value )
{
	$postedValue = htmlspecialchars( stripslashes( $value ), ENT_QUOTES ) ;
    $valuearr[$i] = $postedValue; 
$i++;
}

$path = '\xampp\htdocs\ssc\images/';
$pic = $_FILES["file"]["name"];
$tmplocation = $_FILES["file"]["tmp_name"];
  
	if ($pic=='')
    {
      echo $pic . " already exists. ";
	  $update = "UPDATE user SET
				user_name='$valuearr[0]',
				user_email='$valuearr[1]',
				user_tel='$valuearr[2]',
				user_address='$valuearr[3]',
				password='$valuearr[5]',
				picture='$valuearr[6]'
				WHERE username='$valuearr[5]'";
	  //echo $update;
	  $result = mysqli_query($dbconn, $update) or die ("Error: " . mysqli_error($dbconn));
	  if ($result) {
	  ?>
	  <script type="text/javascript">
	  	window.location = "update_view_user.php"
	  </script>
	  <?php }
    }
    else
    {
      move_uploaded_file($tmplocation, $path . $pic);

	  $update = "UPDATE user SET
				user_name='$valuearr[0]',
				user_email='$valuearr[1]',
				user_tel='$valuearr[2]',
				user_address='$valuearr[3]',
				password='$valuearr[5]',
				picture='$valuearr[6]'
				WHERE username='$valuearr[5]'";
	  //echo $update;
	  $result = mysqli_query($dbconn, $update) or die ("Error: " . mysqli_error($dbconn));

	  if ($result) {
	  ?>
	  <script type="text/javascript">
	  	window.location = "update_view_user.php"
	  </script>
	  <?php }       
     } 
?>