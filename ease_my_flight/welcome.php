<?php
// Initialize the session
session_start();
 
// If session variable is not set it will redirect to login page
if(!isset($_SESSION['pnr']) || empty($_SESSION['pnr'])){
  header("location: index.php");
  exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ 
			font: 14px sans-serif; text-align: center;
			background: url(images/airline.jpg) no-repeat center center fixed; 
			-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
			background-size: cover;
		}
    </style>
</head>
<body>
    <div class="page-header">
        <h1>Hello, <b><?php echo $_SESSION['pnr']; ?></b>. Welcome to our site.</h1>
    </div>
    <p><a href="seat.php" class="btn btn-danger">Go Back to Seat Matching Home Page</a></p>
</body>
<form method="post">
    <input type="submit" name="test" id="test" value="Refresh" /><br/>
</form>

<?php

	function testfun()
	{
	   //echo "Your test function on button click is working";
	   swap_seats(true);
	}

	if(array_key_exists('test',$_POST)){
	   testfun();
	}

?>
</html>

<?php
swap_seats(false);
?>

<?php
function swap_seats($flag)
{
	$DB_SERVER = 'localhost';
	$DB_USERNAME = 'root';
	$DB_PASSWORD = '';
	$DB_NAME = 'user_db';
	
	 
	/* Attempt to connect to MySQL database */
	//$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
	$link = mysqli_connect($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
 
	// Check connection
	if($link === false){
		die("ERROR: Could not connect. " . mysqli_connect_error());
	}
	$curr_pnr = $_SESSION['pnr'];
	
	//Swap seats
	//1. request aayi,uski choice available hai ya nahi
	
	$choiceseatsql = "SELECT choice_seat FROM user_req WHERE pnr = $curr_pnr";
	$currentseatsql = "SELECT current_seat FROM user_req WHERE pnr = $curr_pnr";

	$choiceseat = mysqli_query($link, $choiceseatsql);
	$choiceseat_type="";
	if(mysqli_num_rows($choiceseat) > 0){
		$row = mysqli_fetch_assoc($choiceseat);
		$choiceseat_type = $row["choice_seat"];
		//echo $row["choice_seat"];
	}else{
		mysqli_close($link);
		return;
	}

	$currentseat = mysqli_query($link, $currentseatsql);
	$currentseat_type = "";
	if(mysqli_num_rows($currentseat) > 0){
		$row = mysqli_fetch_assoc($currentseat);
		$currentseat_type = $row["current_seat"];
		//echo $row["current_seat"];
	}else{
		mysqli_close($link);
		return;
	}

	//echo "Choice seat type: " . $choiceseat_type . "Current seat type: " . $currentseat_type . "";

	$pnrnosql = "SELECT pnr FROM user_req WHERE choice_seat = '$currentseat_type' AND current_seat = '$choiceseat_type'";
	//echo "\n";
	//echo $pnrnosql;
	$pnrno_query = mysqli_query($link, $pnrnosql);
	$pnr_no = "";
	$match = false;
	if(mysqli_num_rows($pnrno_query) > 0){
		$row = mysqli_fetch_assoc($pnrno_query);
		$pnr_no = $row["pnr"];
		//echo $row["pnr"];
		$match = true;
		//if($flag==true)
			//echo "Delete";
	}else{
		mysqli_close($link);
		return;
	}
	
	if($match){
		
		//echo "PNR NO: " . $pnr_no . "";
		$newseat_no_sql = "SELECT seat_num FROM user_req WHERE pnr = $pnr_no";
		$newseat_no_query = mysqli_query($link, $newseat_no_sql);
		$newseat_no = "NULL";
		if(mysqli_num_rows($newseat_no_query) > 0){
			$row = mysqli_fetch_assoc($newseat_no_query);
			$newseat_no = $row["seat_num"];
			//echo $row["choice_seat"];
			//echo " Congratulations!! Match Found, Seat number: " . $newseat_no . " You may swap your seats ";
			echo "<h2>Congratulations!! Match Found, Seat number: " . $newseat_no . ".";
			echo "<h2>You may swap your seats.</h2>";
			if($flag){
				//delete entries
				//echo "delete entries";
				
				$deletesql = "DELETE FROM user_req WHERE pnr = $pnr_no";
				$delete_query = mysqli_query($link, $deletesql);
				
				$deletesql1 = "DELETE FROM user_req WHERE pnr = $curr_pnr";
				$delete_query1 = mysqli_query($link, $deletesql1);
			}	
		}
	}
	
	
	//if($seatno > 0){
		//echo "Match found. Your new seat no is :";
		//echo $seatno;
	//}

	//DELETE FROM user_req WHERE seatnumber=$seatno;
	//DELETE FROM user_req WHERE pnr=$pnr;
	// Close connection
	mysqli_close($link);	

}

?>