<!DOCTYPE html>
<?php
include('../include/dbconn.php');

include("../login/session.php");
session_start();

if (!isset($_SESSION['username'])) {
  header('Location: ../login');
}
$username = $_SESSION['username'];
$sqlUSER = "SELECT * FROM user where username = '$username' ";
$queryUSER = mysqli_query($dbconn, $sqlUSER) or die("Error: " . mysqli_error());
$rowUSER = mysqli_num_rows($queryUSER);
$rUSER = mysqli_fetch_assoc($queryUSER);
$user_id = $rUSER['user_name'];
date_default_timezone_set("Asia/Kuala_Lumpur");
$date = date("Y-m-d");
$time = date("H:i:s");

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

    .greatinguser {
      text-transform: uppercase;
    }

    .main {
      margin-left: 200px;
      /* Same as the width of the sidenav */
    }

    .container {
      font-family: "Lato", sans-serif;
      color: #000000;
      margin-left: 200px;
    }

    @media screen and (max-height: 450px) {
      .sidenav {
        padding-top: 15px;
      }

      .sidenav a {
        font-size: 18px;
      }
    }
  </style>



</head>

<body>

  <div class="sidenav">
    <a href="../index.html">HOME</a>
    <a href="#">ABOUT</a>
    <a href="#">CAR</a>
    <a href="#">CONTACT</a>
    <!--<a href="login/index.html">LOGIN</a>
  <a href="signup/index.html">SIGNUP</a>-->
    <br>
    <b> Customer Dashboard</b>
    <a href="../login/logout.php">Logout</a>
    <br>

    <b>User</b>
    <a href="view_user.php">View</a>
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
      <h1><?php echo $_SESSION['username']; ?></h1>
      <h3>Car Rental Customer Dashboard</h3>
    </div>
  </div>

  <div class="container">

    <h3></h3>

    <fieldset>
      <!--  (Recipt Code)  -->
      <?php

      if (isset($_POST['submit'])) {

        $dateo = $_POST['dateo'];
        $datep = $_POST['datep'];
        $daten = $_POST['daten'];
        $pstatus = "processing";

        $row = $_POST['bil'];

        $oid = "oid";
        $pid = "pid";
        $pname = "pname";
        $quantity = "quantity";
        $pprice = "productPrice";
        $order_id = "usage_id";

        $sql = "SELECT * FROM booking ";
        $query = mysqli_query($dbconn, $sql) or die("Error: " . mysqli_error());
        $rows = mysqli_num_rows($query);

        if ($rows != 0) {

          $order_id = $rows + 1;
        }

        echo "<form id='recipt' name='recipt' method='post' action=''>
                      <table width=\"680\" border=\"0\" align=\"center\">
                        <tr>
                          <td colspan=\"5\" align=\"center\"><b>RECEIPT</b></td>
                        </tr>
						<tr>
                          <td colspan=\"5\" align=\"center\">Car Rental</td>
                        </tr>
                        <tr>
                          <td colspan=\"5\" align=\"center\">Made Just For You</td>
                        </tr>
                        <tr>
                          <td colspan=\"5\"></td>
                        </tr>
                        <tr>
                          <td colspan=\"5\"></td>
                        </tr>
                        <tr>
                          <td>Transaction</td>
                          <td colspan=\"4\">: . $order_id .</td>
                        </tr>
                        <tr>
                          <td>Booking</td>
                          <td colspan=\"4\">: Date &nbsp;" . $date . "&nbsp;&nbsp;Time &nbsp;" . $time . "</td>
                        </tr>
						<tr>
                          <td>Date</td>
                          <td colspan=\"4\">: Start &nbsp;" . $datep . "&nbsp;&nbsp;Return &nbsp;" . $daten . "</td>
                        </tr>
						<tr>
                          <td>User Name</td>
                          <td colspan=\"4\">: " . $username . "</td>
                        </tr>
                        <tr>
                          <td colspan=\"5\"><hr /></td>
                        </tr>
                        <tr>
                          <td width=\"45\">Code</td>
                          <td width=\"1000\">Name</td>
                          <td width=\"45\">Price/Unit</td>
                          <td width=\"45\">Quantity</td>
                          <td width=\"45\">Total</td>
                        </tr>";

        $itemCount = 0;
        $totalPrice = 0;
        $strCash = $_POST['cash'];
        $cash = intval($strCash);

        for ($a = 0; $a < $row; $a++) {
          $strpid = $_POST['' . $pid . $a . ''];
          $strQuantity = $_POST[$quantity . $a];
          $strPrice = $_POST[$pprice . $a];

          $sqlf = "SELECT * FROM car WHERE car_no = '$strpid'";
          $queryf = mysqli_query($dbconn, $sqlf) or die("Error: " . mysqli_error());
          $rowf = mysqli_num_rows($queryf);
          $rf = mysqli_fetch_assoc($queryf);

          $sPid = $rf['car_no'];

          //buat pengiraan utk total setiap line dan quantity
          if ($strQuantity > 0) {
            $sqlordersdetail = "INSERT INTO payment (payment_date, date_return, time_return) 
												   VALUES('" . $order_id . "', '" . $sPid . "', '" . $strQuantity . "')";
            mysqli_query($dbconn, $sqlordersdetail) or die("Error: " . mysqli_error($dbconn));
            $strTotal = ($strPrice * intval($strQuantity));

            echo "<tr>
                                  <td>" . $sPid . "</td>
                                  <td>" . $rf['car_type'] . "</td>
                                  <td>" . $strPrice . "</td>
                                  <td>" . $strQuantity . "</td>
                                  <td>" . $strTotal . "</td>
                                </tr>";
            $itemCount = $itemCount + intval($strQuantity);
            $totalPrice = $totalPrice + (intval($strQuantity) * $strPrice);
          }
        }

        $sqlorders = "INSERT INTO booking (user_name, date_made, usage_date, usage_rdate, status) 
									      VALUES('" . $username . "', '" . $date . "', '" . $datep . "', '" . $daten . "', '" . $pstatus . "')";
        mysqli_query($dbconn, $sqlorders) or die("Error: " . mysqli_error($dbconn));
        $change = intval($cash) - intval($totalPrice);

        echo "
                        <tr>
                          <td colspan=\"5\"><hr /></td>
                        </tr>
                        <tr>
                          <td colspan=\"4\">Item Count</td>
                          <td colspan=\"1\" align=\"right\">" . $itemCount . "</td>
                        </tr>
                        <tr>
                          <td colspan=\"4\">Grand Total</td>
                          <td colspan=\"1\" align=\"right\">" . $totalPrice . "</td>
                        </tr>
                        <tr>
                          <td colspan=\"4\">Cash</td>
                          <td colspan=\"1\" align=\"right\">" . $cash . "</td>
                        </tr>
                            <tr>
                          <td colspan=\"5\"><hr /></td>
                        </tr>
                        <tr>
                          <td colspan=\"4\">Change</td>
                          <td colspan=\"1\" align=\"right\">" . $change . "</td>
                        </tr>
                        <tr>
                          <td colspan=\"5\"><hr /></td>
                        </tr>
                        <tr>
                          <td colspan=\"5\" align=\"center\">Thank You</td>
                        </tr>
                        <tr>
                          <td colspan=\"5\" align=\"center\">Plese Come Again</td>
                        </tr>
                      </table>
                    </form>";
      }
      ?>
    </fieldset>
  </div>
</body>

</html>