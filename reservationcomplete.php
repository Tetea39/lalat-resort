<?php
session_start();
require('config.php');
require('vendor/autoload.php');

use Razorpay\Api\Api;

if (!empty($_SESSION['total_amount'])) {

	$_SESSION['amount'] = $_SESSION['total_amount'];
	// $_SESSION['amount'] = 1;
	$_SESSION['name'] = $_SESSION['firstname'] . ' ' . $_SESSION['lastname'];
	$_SESSION['email'] = $_SESSION['email'];
	// $_SESSION['booking_id'] = $_SESSION['booking_id'];

	$api = new Api($keyId, $keySecret);

	$orderData = [
		'receipt'         => (string)$_SESSION['booking_id'],
		'amount'          => $_SESSION['amount'] * 100, // 39900 rupees in paise
		'currency'        => $displayCurrency
	];

	$razorpayOrder = $api->order->create($orderData);

	if (!empty($razorpayOrder['id'])) $_SESSION['order_id'] = $razorpayOrder['id'];
}
?>
<!DOCTYPE html>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Reservation</title>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

	<link rel="stylesheet" href="scss/foundation.css">
	<link rel="stylesheet" href="scss/style.css">
	<link href='http://fonts.googleapis.com/css?family=Slabo+13px' rel='stylesheet' type='text/css'>
	<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="icon/css/fontello.css">
	<link rel="stylesheet" href="icon/css/animation.css">
	<!--[if IE 7]><link rel="stylesheet" href="css/fontello-ie7.css"><![endif]-->
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
	<script src="jquery.backstretch.min.js"></script>
	<!-- Script for razorpay Checkout -->
	<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
	<link href='http://fonts.googleapis.com/css?family=Slabo+27px' rel='stylesheet' type='text/css'>
	<meta class="foundation-data-attribute-namespace">
	<meta class="foundation-mq-xxlarge">
	<meta class="foundation-mq-xlarge">
	<meta class="foundation-mq-large">
	<meta class="foundation-mq-medium">
	<meta class="foundation-mq-small">
	<meta class="foundation-mq-topbar">
	<!-- Button Style for Payment -->
	<style>
		.pay-button {
			background-color: #F37254;
			color: white;
			border: none;
			padding: 15px 30px;
			font-size: 16px;
			border-radius: 5px;
			cursor: pointer;
			transition: background-color 0.3s ease;
		}

		.pay-button:hover {
			background-color: #d85a40;
		}
	</style>
	<script>
		function openRazorpayCheckout() {
			var options = {
				"key": "<?php echo $keyId; ?>",
				"amount": "<?php echo $_SESSION['amount']; ?>",
				"currency": "<?php echo $displayCurrency; ?>",
				"name": "<?php echo $companyName; ?>",
				"description": "Booking Web App",
				"image": "./img/lalat3.png",
				"order_id": "<?php echo $_SESSION['order_id']; ?>",
				"handler": function(response) {
					document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
					document.getElementById('razorpay_order_id').value = response.razorpay_order_id;
					document.getElementById('razorpay_signature').value = response.razorpay_signature;
					document.getElementById('paymentForm').submit();
				},
				"prefill": {
					"name": "<?php echo $_SESSION['name']; ?>",
					"email": "<?php echo $_SESSION['email']; ?>"
				},
				"theme": {
					"color": "#F37254"
				}
			};
			var rzp1 = new Razorpay(options);
			rzp1.open();
		}
	</script>
</head>

<body class="fontbody">
	<nav class="navbar navbar-expand-sm navbar-dark" style="background-color: #1C2331">
		<div class="container-fluid">
			<a class="navbar-brand" href="#"><img src="./img/lalat3.png" alt="" srcset=""></a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="collapsibleNavbar">
				<ul class="navbar-nav">
					<li class="nav-item">
						<a class="nav-link" href="#">Gallery</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#">Link</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#">Link</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>

	<div class="row foo" style="margin:30px auto 30px auto;">
		<div class="large-12 columns">
			<div class="large-3 columns centerdiv">
				<a href="sessiondestroy.php" class="button round blackblur fontslabo">1</a>
				<p class="fontgrey">Please select Date</p>
			</div>
			<div class="large-3 columns centerdiv">
				<a href="unsetroomchosen.php" class="button round blackblur fontslabo">2</a>
				<p class="fontgrey">Select Room</p>
			</div>
			<div class="large-3 columns centerdiv">
				<a href="guestform.php" class="button round  blackblur fontslabo">3</a>
				<p class="fontgrey">Guest Details</p>
			</div>
			<div class="large-3 columns centerdiv">
				<a href="#" class="button round fontslabo" style="background-color:#2ecc71;">4</a>
				<p class="fontgrey">Reservation Complete</p>
			</div>
		</div>

	</div>
	</div>

	<div class="row">
		<div class="large-4 columns blackblur fontcolor" style="margin-left:-10px; padding:10px;">

			<div class="large-12 columns ">
				<p><b>Your Reservation</b></p>
				<hr class="line">
				<form name="guestdetails" action="unsetroomchosen.php" method="post">
					<div class="row">
						<div class="large-12 columns">
							<div class="row">

								<div class="large-5 columns" style="max-width:100%;">
									<span class="fontgreysmall">Check In
									</span>
								</div>

								<div class="large-5 columns" style="max-width:100%;">
									<span class="">: <?php echo $_SESSION['checkin_date']; ?>
									</span>

								</div>
							</div>
							<div class="row">
								<div class="large-5 columns" style="max-width:100%;">
									<span class="fontgreysmall">Check Out
									</span>
								</div>

								<div class="large-5 columns" style="max-width:100%;">
									<span class="">: <?php echo $_SESSION['checkout_date']; ?>
									</span>

								</div>
							</div>
							<div class="row">
								<div class="large-5 columns" style="max-width:100%;">
									<span class="fontgreysmall">Adults
									</span>
								</div>

								<div class="large-5 columns" style="max-width:100%;">
									<span class="">: <?php echo $_SESSION['adults']; ?>
									</span>

								</div>
							</div>
							<div class="row">
								<div class="large-5 columns" style="max-width:100%;">
									<span class="fontgreysmall">Childrens
									</span>
								</div>

								<div class="large-5 columns" style="max-width:100%;">
									<span class="">: <?php echo $_SESSION['childrens']; ?>
									</span>

								</div>
							</div>
							<div class="row">
								<div class="large-5 columns" style="max-width:100%;">
									<span class="fontgreysmall">Night Stay(s)
									</span>
								</div>

								<div class="large-5 columns" style="max-width:100%;">
									<span class="">: <?php echo $_SESSION['total_night']; ?>
									</span>

								</div>
							</div>
							<div class="row">
								<hr>
								<div class="large-6 columns" style="max-width:100%;">
									<span class="fontgreysmall">Room Selected
									</span>
								</div>

								<div class="large-4 columns" style="max-width:100%;">
									<span class="fontgreysmall">Qty
									</span>

								</div>
							</div>
							<div class="row">
								<div class="large-6 columns" style="max-width:100%;">
									<span class=""><?php

													foreach ($_SESSION['roomname'] as &$value0) {
														echo $value0;
														print "<br>";
													};

													?>

									</span>
								</div>

								<div class="large-4 columns" style="max-width:100%;">
									<span class="">
										<?php foreach ($_SESSION['roomqty'] as &$value1) {
											echo $value1;
											print "<br>";
										};

										?>
									</span>

								</div>
							</div>

						</div>
					</div><br>
					<div class="row">
						<div class="large-12 columns" style="max-width:100%;">
							<p class="fontgrey borderstyle" style="text-align:center;">15% Deposit Due Now<br>
								<span class="fontslabo " style="font-size:32px; text-align:center;">INR
									<?php echo $_SESSION['deposit']; ?></span>
								<br><span class="fontgrey" style="text-align:center;">Total</span><br>
								<span class="fontslabo" style="font-size:32px; text-align:center;">INR
									<?php echo $_SESSION['total_amount']; ?></span>
							</p>

						</div>

						<div class="large-12 columns" style="max-width:100%;">


						</div>
					</div>



					<div class="row">
						<div class="large-12 columns">
							<button name="submit" href="#" class="button small fontslabo" style="background-color:#2ecc71; width:100%;">Edit Reservation</button>
						</div>
					</div>
				</form>
			</div>



		</div>
		<div class="large-8 columns blackblur fontcolor" style="padding:10px">

			<div class="large-12 columns">
				<p><b>Reservation Complete</b></p>
				<hr class="line">
				<p>Details of your reservation have just been sent to you
					in a confirmation email. Please check your spam folder if you didn't received any email. We look
					forward to see you soon. In the
					meantime, if you have any questions, feel free to contact us.</p>
				<p>
					<i class="icon-phone" style="font-size:24px"></i> <span class="i-name fontgrey">Phone</span><span class="i-code">&emsp; 9368279889</span><br>
					<!-- <i class="icon-fax" style="font-size:24px"></i> <span class="i-name fontgrey">Fax</span><span class="i-code"> &emsp;&emsp;60328951744</span><br> -->
					<i class="icon-mail-alt" style="font-size:24px"> </i> <span class="i-name fontgrey">Email</span><span class="i-code">&emsp; info@lalat.co.in</span>
				</p>
				<hr>
				<div class="row">
					<div class="large-12 columns">
						<!--form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top" >
					<input type="hidden" name="cmd" value="_xclick">
					<input type="hidden" name="business" value="mrzulkarnine@gmail.com">
					<input type="hidden" name="lc" value="MY">
					<input type="hidden" name="item_name" value="15% Hotel Deposit Payment">
					<input type="hidden" name="amount" value="<?php $amount = $_SESSION['deposit'];
																print $amount; ?>">
					<input type="hidden" name="currency_code" value="MYR">
					<input type="hidden" name="button_subtype" value="services">
					<input type="hidden" name="no_note" value="0">
					<input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynowCC_LG.gif:NonHostedGuest">
					<img type="image" src="img/paypal.jpg" style="background-color:white; width:32%; height:14%; padding:2px; " ></img>
					<br><button class="button small " border="0" name="submit" alt="PayPal - The safer, easier way to pay online!" style="width:32%;background-color:#2ecc71; ">Pay Room Deposit Now</button>
					<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
					</form-->
						<!-- <form action="checkout.php" method="post" target="_top">
							<input type="hidden" name="name" value="<?php echo $_SESSION['firstname'] . ' ' . $_SESSION['lastname'] ?>">
							<input type="hidden" name="booking_id" value="<?php echo $_SESSION['booking_id'] ?>">
							<input type="hidden" name="amount" value="<?php echo $_SESSION['total_amount'] ?>">

							<input type="hidden" name="cmd" value="_s-xclick">
							<input type="hidden" name="hosted_button_id" value="3FWZ42DLC5BJ2">
							<input type="hidden" name="lc" value="MY">
							<input type="hidden" name="item_name" value="15% Hotel Deposit Payment for Booking ID #<?php echo $_SESSION['booking_id']; ?>">
							<input type="hidden" name="amount" value="<?php $amount = $_SESSION['deposit'];
																		print $amount; ?>">
							<input type="hidden" name="currency_code" value="MYR">
							<input type="hidden" name="button_subtype" value="services">
							<input type="hidden" name="no_note" value="0">
							<input type="hidden" name="custom" value="<?php echo $_SESSION['booking_id']; ?>">
							<input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynowCC_LG.gif:NonHostedGuest">
							<img type="image" src="img/paypal.jpg" style="background-color:white; width:32%; height:14%; padding:2px; "></img>
							<br> -->
						<!-- <button id="PayNow" class="button small " name="submit" alt="PayPal - The safer, easier way to pay online!" style="width:32%;background-color:#2ecc71; ">Pay Room Deposit Now</button> -->
						<!-- </form> -->
						<!-- Pay Button Form -->
						<img alt="" src="https://www.ecommerce-nation.com/wp-content/uploads/2019/02/razorpay.webp" width="230rem" height="90rem">
						<form style="padding-top: 1rem;" id="paymentForm" action="<?php echo $baseURL; ?>success.php" method="POST">
							<input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
							<input type="hidden" name="razorpay_order_id" id="razorpay_order_id">
							<input type="hidden" name="razorpay_signature" id="razorpay_signature">
							<button type="button" class="pay-button" onclick="openRazorpayCheckout()">Pay <?php echo $_SESSION['amount']; ?> with Razorpay</button>
						</form>


					</div>
				</div>
			</div>



		</div>


	</div>

	<script>
	</script>




	<!-- Remove the container if you want to extend the Footer to full width. -->
	<div class="container my-5">

		<!-- Footer -->
		<footer class="text-center text-lg-start text-white" style="background-color: #1c2331">
			<!-- Section: Social media -->
			<section class="d-flex justify-content-between p-4" style="background-color: #6351ce">
				<!-- Left -->
				<div class="me-5">
					<span>Get connected with us on social networks:</span>
				</div>
				<!-- Left -->

				<script src="https://kit.fontawesome.com/e74869c2fd.js" crossorigin="anonymous"></script>

				<!-- Right -->
				<div>
					<a href="https://www.facebook.com/profile.php?id=100090963160287" class="text-white me-4">
						<i class="fab fa-facebook-f"></i>
					</a>
					<!-- <a href="" class="text-white me-4">
          <i class="fab fa-twitter"></i>
        </a> -->
					<!-- <a href="" class="text-white me-4">
          <i class="fab fa-google"></i>
        </a> -->
					<a href="https://www.instagram.com/lalat_resort/" class="text-white me-4">
						<i class="fab fa-instagram"></i>
					</a>



				</div>
				<!-- Right -->
			</section>
			<!-- Section: Social media -->

			<!-- Section: Links  -->
			<section class="">
				<div class="container text-center text-md-start mt-5">
					<!-- Grid row -->
					<div class="row mt-3">
						<!-- Grid column -->
						<div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
							<!-- Content -->
							<h6 class="text-uppercase fw-bold text-light">Lalat Resort</h6>
							<hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #7c4dff; height: 2px" />
							<p>
								The Lalat Resort is a serene retreat where luxury meets comfort. - Discover a haven that
								enchants your senses from the moment you step in.
							</p>
						</div>
						<!-- Grid column -->

						<!-- Grid column -->
						<div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
							<!-- Links -->
							<h6 class="text-uppercase fw-bold text-light">Facilities</h6>
							<hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #7c4dff; height: 2px" />
							<p>
								<a href="#!" class="text-white">Event Hall</a>
							</p>
							<p>
								<a href="#!" class="text-white">Resturant</a>
							</p>
							<p>
								<a href="#!" class="text-white">Trekking</a>
							</p>

						</div>
						<!-- Grid column -->

						<!-- Grid column -->
						<div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
							<!-- Links -->
							<h6 class="text-uppercase fw-bold text-light">Useful links</h6>
							<hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #7c4dff; height: 2px" />
							<p>
								<a href="./admin/index.htm" class="text-white">Admin</a>
							</p>
							<p>
								<a href="#!" class="text-white">Career</a>
							</p>
							<p>
								<a href="./privacypolicy.php" class="text-white">Privacy Policy</a>
							</p>
							<p>
								<a href="./termsandconditions.php" class="text-white">Terms and Conditions</a>
							</p>
							<p>
								<a href="./cancellationandrefund.php" class="text-white">Cancellation and Refund</a>
							</p>
							<!-- <p>
              <a href="#!" class="text-white">Shipping Rates</a>
            </p> -->

						</div>
						<!-- Grid column -->

						<!-- Grid column -->
						<div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
							<!-- Links -->
							<h6 class="text-uppercase fw-bold text-light">Contact</h6>
							<hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #7c4dff; height: 2px" />
							<p><i class="fas fa-home mr-3"></i>Aizawl, Mizoram</p>
							<p><i class="fas fa-envelope mr-3"></i>info@lalat.com</p>
							<p><i class="fas fa-phone mr-3"></i> +91 9362879889</p>
						</div>
						<!-- Grid column -->
					</div>
					<!-- Grid row -->
				</div>
			</section>
			<!-- Section: Links  -->

			<!-- Copyright -->
			<div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
				© 2024 Copyright:
				<a class="text-white" href="#">Lalat Resort</a>
			</div>
			<!-- Copyright -->
		</footer>
		<!-- Footer -->

	</div>
	<!-- End of .container -->





</body>

</html>