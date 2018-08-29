<?php
   ob_start();
   session_start();
?>

<?
   // error_reporting(E_ALL);
   // ini_set("display_errors", 1);
?>

<html lang = "en">
   
   <head>
      <title>Seat_Match</title>
      <link href = "css/bootstrap.min.css" rel = "stylesheet">
      
      <style>
         body {
            /*padding-top: 40px;
            //padding-bottom: 40px;
            //background-color: #ADABAB;*/
			background: url(images/airline.jpg) no-repeat center center fixed; 
			-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
			background-size: cover;
         }
         
         .form-signin {
            max-width: 330px;
            padding: 15px;
            margin: 0 auto;
            color: #017572;
         }
         
         .form-signin .form-signin-heading,
         .form-signin .checkbox {
            margin-bottom: 10px;
         }
         
         .form-signin .checkbox {
            font-weight: normal;
         }
         
         .form-signin .form-control {
            position: relative;
            height: auto;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            padding: 10px;
            font-size: 16px;
         }
         
         .form-signin .form-control:focus {
            z-index: 2;
         }
         
         .form-signin input[type="email"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
            border-color:#017572;
         }
         
         .form-signin input[type="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
            border-color:#017572;
         }
         
         h2{
            text-align: center;
            color: #017572;
         }
      </style>
      
   </head>
	
   <body>
      
      <h2>Welcome to the On-Air Service System</h2> 
      <div class = "container form-signin">
         
		 
			
      </div> <!-- /container -->
      
      <div class = "container">
      
	  <p>
		<h4>Seat Matching</h4>
		<a href="seat.php">
			<img border="0" alt="seat match" src="images/seat.png" align="middle" width="200" height="200">
		</a>
	</p>
	<p>
		<h4>Service Request</h4>
		<a href="service.php">
			<img border="0" alt="service" src="images/seat.png" align="middle" width="200" height="200">
		</a>
	</p>
	  
	  
      </div> 
      
   </body>
</html>