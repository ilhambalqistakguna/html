<?php 
include('../include/dbconn.php');

$i=0;

foreach ( $_POST as $sForm => $value )
{
	$postedValue = htmlspecialchars( stripslashes( $value ), ENT_QUOTES ) ;
    $valuearr[$i] = $postedValue; 
$i++;
}



echo $valuearr[0].'<br>'.$valuearr[1].'<br>'.$valuearr[2].'<br>'.$valuearr[3].'<br>'.$valuearr[4].'<br>'.$valuearr[5].'<br>'.$valuearr[6].'<br>';

	$sql0 = "SELECT username FROM user WHERE username = '$valuearr[4]'";
	$query0 = mysqli_query($dbconn, $sql0) or die ("Error: " . mysqli_error($dbconn));
	$row0 = mysqli_num_rows($query0);
	
	if($row0 != 0){
	header('Location: ../signup/indexrecordexist.html');
	//echo "<b>Record is existed</b>";
	}
	else{
	/* execute SQL INSERT command */
	$sql2 = "INSERT INTO user (username,password,user_name,user_email,user_tel,user_address,level_id)
	VALUES ('$valuearr[4]', '$valuearr[5]', '$valuearr[0]', '$valuearr[1]', '$valuearr[2]', '$valuearr[3]', '$valuearr[6]')";
		mysqli_query($dbconn, $sql2) or die ("Error: " . mysqli_error($dbconn));
	/* rediredt to respective page */
	header('Location: ../user/index.php');
	//echo "Data has been saved";
	}

	/* close db connection */
	mysqli_close($dbconn);


?>
