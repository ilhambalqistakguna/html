<!DOCTYPE html>
<?php 
include('../include/dbconn.php');

include ("../login/session.php");
session_start();

if (!isset($_SESSION['username'])) {
        header('Location: ../login');
		} 
				$user_name = $_SESSION['username'];
				$sqlUSER = "SELECT * FROM user where username = '$user_name' ";
				$queryUSER = mysqli_query($dbconn, $sqlUSER) or die ("Error: " . mysqli_error());
				$rowUSER = mysqli_num_rows($queryUSER);
				$rUSER= mysqli_fetch_assoc($queryUSER);

                date_default_timezone_set("Asia/Kuala_Lumpur");
                $date = date("d/m/Y");
                $time = date("H:i:s");
				
				$id = $_GET['username'];	
				
?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  font-family: "Lato", sans-serif;
  color: #cc7a00;
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




<script type = "text/javascript">
function calc() 
{
var total = 0;
var rowNo = order.elements["bil"].value;
var qProduct = "quantity";
var pProduct ="productPrice";

for (a=0;a<rowNo;a++)
{
	var textRow = a.toString();
	var textQuantity = qProduct + textRow;
	var textPrice = pProduct + textRow;
	var quantity = parseInt(order.elements[textQuantity].value)
	var pPrice = parseInt(order.elements[textPrice].value);
	total = total + (quantity * pPrice);
}
document.getElementById("price").value = total;
document.getElementById("cash").min = total;
}

</script>


</head>
<body>

<div class="sidenav">
  <a href="../index.php">HOME</a>
  <br>
  <b> Customer Dashboard</b>
  <a href="../login/logout.php">Logout</a>
  <br>
  
  <b>User</b>
  <a href="view_user.php">View</a>
  <a href="update_user.php">Update</a>
  
  <b>Product</b>
  <a href="view_product.php">View</a>
  <a href="search_product.php">Search</a>
  
  <b>Booking</b>
  <a href="add_order_product.php">Add</a>
  <a href="view_order.php">View</a>
	
</div>


<div class="main">
  <div class="greatinguser">
	<h1><?php echo $_SESSION['username']; ?></h1>
	<h3>Car Rental Customer Dashboard</h3>
  </div> 
</div>

<div class="container">

<h3>Add Booking</h3>

<fieldset>

<form name="order" method="POST"  action="db_add_order_receipt.php">
    <table width="100%" border="0" align="center">
      <tr>
        <td width="">Customer Name</td>  
        <td width=""><?php echo $rUSER['name'] ?>
			<!--<select name="customer" style="min-width:330px;">
				<?php
					while($rUSER= mysqli_fetch_assoc($queryUSER)){
						$cust_name = $rUSER['name'];
						$user_id = $rUSER['user_id'];
						echo"<option value='$user_id'>$cust_name</option>";?>
						
				<?php
					}
				?>
				
			</select>-->
			
		</td>  
      </tr>  
      <tr> 
        <td>Order Date</td>
        <td><input type="date" name="dateo" size="50" hidden /><?php echo $date?></td>
      </tr>
	  <tr>
        <td>Pickup Date</td>
        <td><input type="date" name="datep" size="50" /></td>
      </tr>
	  <tr>
        <td>Pickup Time</td>
        <td><input type="time" name="timep" size="50" /></td>
      </tr>
 
			<?php
				$sql= "SELECT * FROM product ORDER BY product_name,product_category,product_size";
				$query = mysqli_query($dbconn, $sql) or die ("Error: " . mysqli_error());
				$row = mysqli_num_rows($query);
				//$r= mysqli_fetch_assoc($query);
	
                echo "<table border='1' width='100%'  align='center'>";
                echo "<tr>
                        <td width='5%'>Code</td>
                        <td width='40%'>Product Name</td>
						<td width='20%'>Category</td>
						<td width='5%'>Size</td>
                        <td width='5%'>Price</td>
                        <td width='25%'>Quantity</td>
                        </tr>";  
						
         	    $strOid = "oid";
                $strPid = "pid";
                $strPname = "pname";
                $strPcat = "pcat";
                $strPsize = "psize";				
                $strQuantity = "quantity";	
                $strPrice = "productPrice";
                $strTotal = "total";	
                $no=0; 
                
                echo "<input type='text' name='bil' id='bil' value=".$row." hidden>";
                	
				$i=0;								
                while ($r = mysqli_fetch_assoc($query))   
                { 
					$productName = $r['product_name'];
					$productStatus = $r['product_status'];
					$productCat = $r['product_category'];
					$productSize = $r['product_size'];
					$pid = $r['product_id'];
					$productPrice = $r['product_price'];
					if($productStatus == 1)
					{
						echo "<tr>
								<td><center><input type='hidden' class='center' name=".$strPid.$no." id=".$strPid.$no." value =".$r['product_id'].">".$r['product_id']."</td>
								<td>".$r['product_name']."</td>
								<td>";
								
								if ($r['product_category']=='1') 
									echo "Hot";
								else if ($r['product_category']=='2')
									echo "Cold";
								
								echo "</td>
								<td>";
								
								if ($r['product_size']=='1') 
									echo "Large";
								else if ($r['product_size']=='2')
									echo "Medium";
								
								echo "</td>
								<td><center><input type='hidden' class='center' name=".$strPrice.$no." id=".$strPrice.$no." value =".$r['product_price']." readonly'>".$r['product_price']."</td>
								
								<td>";
								
								if ($id== $r['product_id']) 
									echo "<input type='number' name=".$strQuantity.$no." id=".$strQuantity.$no." min='0' max='100' value='1'>";
								else 
									echo "<input type='number' name=".$strQuantity.$no." id=".$strQuantity.$no." min='0' max='100' value='0'>";
								
								
								echo"</td>
								</tr>";
						$no++;
					}
				
					else
					{
						echo "<tr hidden>
								<td><center><input type='hidden' class='center' name=".$strPid.$no." id=".$strPid.$no." value =".$r['product_id'].">".$r['product_id']."</td>
								<td>".$r['product_name']."</td>
								<td>";
								
								if ($r['product_category']=='1') 
									echo "Hot";
								else if ($r['product_category']=='2')
									echo "Cold";
								
								echo "</td>
								<td>";
								
								if ($r['product_size']=='1') 
									echo "Large";
								else if ($r['product_size']=='2')
									echo "Medium";
								
								echo "</td>
								<td><center><input type='hidden' class='center' name=".$strPrice.$no." id=".$strPrice.$no." value =".$r['product_price']." readonly'>".$r['product_price']."</td>
								<td><center><input type='hidden' name=".$strQuantity.$no." id=".$strQuantity.$no." value='0' >Not Available</td>
								</tr>";
						$no++;
					}
				
                }
                
                echo "<tr>
                        <td colspan='2'>&nbsp;</td>
                        <td>
                        <input type='button' name='calculate' id='calculate' onClick='calc()' value='Calculate'></td>
                        <td><input type='text' name='price' id='price' value='0'></td>
                        </tr>
                        <tr>
                        <td colspan='2'>&nbsp;</td>
                        <td><input type='submit' name='submit' id='submit' value='Submit'></td>
						<td><input type='number' name='cash' id='cash' value='0' min='1'></td>
                        </tr>
                        <tr>
                        <td align='center' colspan='4'>
                            <input type='reset' name='reset' id='reset' value='   Reset   ' />	
                        </td>
                        </tr>
                    ";
                echo "</table>";
                
               
                ?>
	  
      <tr> 
        <td colspan="2">
		
		</td>
      </tr>	  
	  
      <tr> 
        <td colspan="2"></td>
      </tr>
	  
    </table>
</form>

</fieldset>
 
</div>
   
</body>

</html> 
