<!DOCTYPE HTML>
<!--
	Aesthetic by gettemplates.co
	Twitter: http://twitter.com/gettemplateco
	URL: http://gettemplates.co
-->
<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Traveler &mdash; Free Website Template, Free HTML5 Template by GetTemplates.co</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Free HTML5 Website Template by GetTemplates.co" />
	<meta name="keywords" content="free website templates, free html5, free template, free bootstrap, free website template, html5, css3, mobile first, responsive" />
	<meta name="author" content="GetTemplates.co" />

  	<!-- Facebook and Twitter integration -->
	<meta property="og:title" content=""/>
	<meta property="og:image" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content=""/>
	<meta property="og:description" content=""/>
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet">
	
	<!-- Animate.css -->
	<link rel="stylesheet" href="css/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="css/icomoon.css">
	<!-- Themify Icons-->
	<link rel="stylesheet" href="css/themify-icons.css">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="css/bootstrap.css">

	<!-- Magnific Popup -->
	<link rel="stylesheet" href="css/magnific-popup.css">

	<!-- Magnific Popup -->
	<link rel="stylesheet" href="css/bootstrap-datepicker.min.css">

	<!-- Owl Carousel  -->
	<link rel="stylesheet" href="css/owl.carousel.min.css">
	<link rel="stylesheet" href="css/owl.theme.default.min.css">

	<!-- Theme style  -->
	<link rel="stylesheet" href="css/style.css">

	<!-- Modernizr JS -->
	<script src="js/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->

	</head>
	<body>
		
		<!-- ########################################################################################## -->
		<?php
		 
			define('DB_SERVER', 'localhost');
			define('DB_USERNAME', 'root');
			define('DB_PASSWORD', '');
			define('DB_NAME', 'user_db');
			 
			/* Attempt to connect to MySQL database */
			$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
			 
			// Check connection
			if($link === false){
				die("ERROR: Could not connect. " . mysqli_connect_error());
			}
		 
            // Define variables and initialize with empty values
			$pnr = $lastname = $choice_seat = $curr_seat = $seat_num = "";
			$lastname_err = $pnr_err = $choice_seat_err = $curr_seat_err = $seat_num_err = "";
			
			
			// Processing form data when form is submitted
			if($_SERVER["REQUEST_METHOD"] == "POST"){
 
				// Check if lastname is empty
				if(empty($_POST["lastname"])){
					$lastname_err =  'Please enter last name.';
				} else{
					$lastname = trim($_POST["lastname"]);
				}
			
				// Check if PNR is empty
				if(empty($_POST['pnr'])){
					$pnr_err = 'Please enter your PNR';
				} else{
					$pnr = trim($_POST['pnr']);
				}
				
				// Check if seat num is empty
				if(empty($_POST['seat_num'])){
					$seat_num_err = 'Please enter your Seat Number';
				} else{
					$seat_num = trim($_POST['seat_num']);
				}

				if(empty($_POST['curr_seat'])){
					$curr_seat_err = "You forgot to select your current seat";
				} else {
					$curr_seat = trim($_POST['curr_seat']);
				}
				
				if(empty($_POST['choice_seat'])){
					$choice_seat_err = "You forgot to select your choice seat";
				} else {
					$choice_seat = trim($_POST['choice_seat']);
				}
				
				//echo "choice_seat ".$choice_seat." current seat: ".$curr_seat." seat number".$seat_num;

				// Validate credentials
				if(empty($lastname_err) && empty($pnr_err) && empty($curr_seat_err) && empty($choice_seat_err) && empty($seat_num_err)){
					$sql = "SELECT lastname FROM user_cred WHERE pnr = $pnr";
					
					$result = mysqli_query($link, $sql);
					
					if (mysqli_num_rows($result) > 0) {
						while($row = mysqli_fetch_assoc($result)) {
							if($row["lastname"] == $lastname){
								/* pnr is correct, so start a new session and
								save the pnr to the session */
								session_start();
								$_SESSION['pnr'] = $pnr;

								
								//insert all the data to user_req table
								$sql_insert = "INSERT INTO user_req (pnr, current_seat, choice_seat, seat_num)
								VALUES ('$pnr', '$curr_seat', '$choice_seat', '$seat_num')";


								//echo $sql_insert;
								if (mysqli_query($link, $sql_insert)) {
									echo "New record created successfully";
								} else {
									echo "Error: " . $sql . "<br>" . $conn->error;
								}

								
								
								header("location: req_success.php");
							} else {
								echo 'The PNR or last name you entered is not valid.';
							}
						}
					} else {
						echo "PNR is not Valid";
					}
					
				} else {
					echo "All Fields are mandatory. Please Fill all fields";
				}
				
				// Close connection
				mysqli_close($link);
			}
      ?>
      <!-- ########################################################################################## -->

	<div class="gtco-loader"></div>
	
	<div id="page">

	
	<!-- <div class="page-inner"> -->
	<nav class="gtco-nav" role="navigation">
		<div class="gtco-container">
			
			<div class="row">
				<div class="col-sm-4 col-xs-12">
					<div id="gtco-logo"><a href="index.html">Ease My Flight <em>.</em></a></div>
				</div>
				<div class="col-xs-8 text-right menu-1">
					<ul>
						<li><a href="#">Destination</a></li>
						<li class="has-dropdown">
							<a href="#">Travel</a>
							<ul class="dropdown">
								<li><a href="#">Europe</a></li>
								<li><a href="#">Asia</a></li>
								<li><a href="#">America</a></li>
								<li><a href="#">Canada</a></li>
							</ul>
						</li>
						<li><a href="pricing.html">Pricing</a></li>
						<li><a href="contact.html">Contact</a></li>
					</ul>	
				</div>
			</div>
			
		</div>
	</nav>
	
	<header id="gtco-header" class="gtco-cover gtco-cover-md" role="banner" style="background-image: url(images/b.jpg)">
		<div class="overlay"></div>
		<div class="gtco-container">
			<div class="row">
				<div class="col-md-12 col-md-offset-0 text-left">
					

					<div class="row row-mt-15em">
						<div class="col-md-7 mt-text animate-box" data-animate-effect="fadeInUp">
							<h1>Wanna Switch Seats?</h1>	
						</div>
						<div class="col-md-4 col-md-push-1 animate-box" data-animate-effect="fadeInRight">
							<div class="form-wrap">
								<div class="tab">
									
									<div class="tab-content">
										<div class="tab-content-inner active" data-content="signup">
											<h3>Please Enter Details</h3>
											<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method = "post">
												<div class="row form-group">
													<div class="col-md-12">
														<label for="fullname">PNR</label>
														<input type="text" name = "pnr" class="form-control">
													</div>
												</div>
												<div class="row form-group">
													<div class="col-md-12">
														<label for="fullname">Last Name</label>
														<input type="text" name = "lastname" class="form-control">
													</div>
												</div>
												<div class="row form-group">
													<div class="col-md-12">
														<label for="fullname">Seat Number</label>
														<input type="text" name = "seat_num" class="form-control">
													</div>
												</div>
												<div class="row form-group">
													<div class="col-md-12">
														<label for="activities">Current Seat Type</label>
														<select name="curr_seat" class="form-control">
															<option value="W">Window</option>
															<option value="M">Middle</option>
															<option value="A">Aisle</option>
														</select>
													</div>
												</div>
												<div class="row form-group">
													<div class="col-md-12">
														<label for="destination">Desired Seat Type</label>
														<select name="choice_seat" class="form-control">
															<option value="W">Window</option>
															<option value="M">Middle</option>
															<option value="A">Aisle</option>
														</select>
													</div>
												</div>
												<div class="row form-group">
													<div class="col-md-12">
														<input type="submit" class="btn btn-primary btn-block" value="Submit" name = "login">
													</div>
												</div>
											</form>	
										</div>

										
									</div>
								</div>
							</div>
						</div>
					</div>
							
					
				</div>
			</div>
		</div>
	</header>

	<footer id="gtco-footer" role="contentinfo">
		<div class="gtco-container">
			<div class="row row-p	b-md">

				<div class="col-md-4">
					<div class="gtco-widget">
						<h3>About Us</h3>
						<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore eos molestias quod sint ipsum possimus temporibus officia iste perspiciatis consectetur in fugiat repudiandae cum. Totam cupiditate nostrum ut neque ab?</p>
					</div>
				</div>

				<div class="col-md-2 col-md-push-1">
					<div class="gtco-widget">
						<h3>Destination</h3>
						<ul class="gtco-footer-links">
							<li><a href="#">Europe</a></li>
							<li><a href="#">Australia</a></li>
							<li><a href="#">Asia</a></li>
							<li><a href="#">Canada</a></li>
							<li><a href="#">Dubai</a></li>
						</ul>
					</div>
				</div>

				<div class="col-md-2 col-md-push-1">
					<div class="gtco-widget">
						<h3>Hotels</h3>
						<ul class="gtco-footer-links">
							<li><a href="#">Luxe Hotel</a></li>
							<li><a href="#">Italy 5 Star hotel</a></li>
							<li><a href="#">Dubai Hotel</a></li>
							<li><a href="#">Deluxe Hotel</a></li>
							<li><a href="#">BoraBora Hotel</a></li>
						</ul>
					</div>
				</div>

				<div class="col-md-3 col-md-push-1">
					<div class="gtco-widget">
						<h3>Get In Touch</h3>
						<ul class="gtco-quick-contact">
							<li><a href="#"><i class="icon-phone"></i> +1 234 567 890</a></li>
							<li><a href="#"><i class="icon-mail2"></i> info@GetTemplates.co</a></li>
							<li><a href="#"><i class="icon-chat"></i> Live Chat</a></li>
						</ul>
					</div>
				</div>

			</div>

			<div class="row copyright">
				<div class="col-md-12">
					<p class="pull-left">
						<small class="block">&copy; 2016 Free HTML5. All Rights Reserved.</small> 
						<small class="block">Designed by <a href="http://GetTemplates.co/" target="_blank">GetTemplates.co</a> Demo Images: <a href="http://unsplash.com/" target="_blank">Unsplash</a></small>
					</p>
					<p class="pull-right">
						<ul class="gtco-social-icons pull-right">
							<li><a href="#"><i class="icon-twitter"></i></a></li>
							<li><a href="#"><i class="icon-facebook"></i></a></li>
							<li><a href="#"><i class="icon-linkedin"></i></a></li>
							<li><a href="#"><i class="icon-dribbble"></i></a></li>
						</ul>
					</p>
				</div>
			</div>

		</div>
	</footer>
	<!-- </div> -->

	</div>

	<div class="gototop js-top">
		<a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
	</div>
	
	<!-- jQuery -->
	<script src="js/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script src="js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="js/jquery.waypoints.min.js"></script>
	<!-- Carousel -->
	<script src="js/owl.carousel.min.js"></script>
	<!-- countTo -->
	<script src="js/jquery.countTo.js"></script>

	<!-- Stellar Parallax -->
	<script src="js/jquery.stellar.min.js"></script>

	<!-- Magnific Popup -->
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/magnific-popup-options.js"></script>
	
	<!-- Datepicker -->
	<script src="js/bootstrap-datepicker.min.js"></script>
	

	<!-- Main -->
	<script src="js/main.js"></script>

	</body>
</html>

