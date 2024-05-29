<?php
session_start();

require('config.php');

include './auth.php';

$email = "";
$fname = "";
$lname = "";
$total = "";
$deposit = "";
$bal = "";
$id = $_SESSION['booking_id'];

if (!empty($_POST)) {
	$order_id = $_SESSION['order_id'];

	//response from razorpay
	$razorpay_order_id = $_POST['razorpay_order_id'];
	$razorpay_signature = $_POST['razorpay_signature'];
	$razorpay_payment_id = $_POST['razorpay_payment_id'];

	// Generate server side signature
	$generated_signature = hash_hmac('sha256', $order_id . "|" . $razorpay_payment_id, $keySecret);

	if ($generated_signature == $razorpay_signature) {
		// Success
		if (isset($id) && !empty($id)) {
			$r = mysqli_query($dbhandle, "UPDATE  `booking` SET  `payment_status` =  'confirmed' WHERE  `booking_id` = " . $id . ";");
			// echo mysqli_error();
			$result = mysqli_query($dbhandle, "select * from booking where booking_id = '" . $id . "';");
			if (mysqli_num_rows($result) > 0) {
				while ($row = mysqli_fetch_array($result)) {
					$email = $row['email'];
					$fname = $row['first_name'];
					$lname = $row['last_name'];
					$total = $row['total_amount'];
					$deposit = $row['deposit'];
					$bal = $row['total_amount'] - $row['deposit'];
				}
			}
		}
	} else {
		// Failure
		$r = mysqli_query($dbhandle, "UPDATE  `booking` SET  `payment_status` =  'failed' WHERE  `booking_id` = " . $id . ";");
		// echo mysqli_error();
		$result = mysqli_query($dbhandle, "select * from booking where booking_id = '" . $id . "';");
		if (mysqli_num_rows($result) > 0) {
			while ($row = mysqli_fetch_array($result)) {
				$email = $row['email'];
				$fname = $row['first_name'];
				$lname = $row['last_name'];
				$total = $row['total_amount'];
				$deposit = $row['deposit'];
				$bal = $row['total_amount'] - $row['deposit'];
			}
		}
	}
}


$subject = "Deposit Amount Received";
$message = "<html>";
$message .= "<body>\n";
$message .= "<table class=\"body-wrap\">\n";
$message .= "	<tr>\n";
$message .= "		<td></td>\n";
$message .= "		<td class=\"container\" width=\"600\">\n";
$message .= "			<div class=\"content\">\n";
$message .= "				<table class=\"main\" width=\"100%\" cellpadding=\"0\" cellspacing=\"0\">\n";
$message .= "					<tr>\n";
$message .= "						<td class=\"content-wrap aligncenter\">\n";
$message .= "							<table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\">\n";
$message .= "								<tr>\n";
$message .= "									<td class=\"content-block\">\n";
$message .= "										<h1>Your Deposit Payment Received!</h1>\n";
$message .= "									</td>\n";
$message .= "								</tr>\n";
$message .= "								<tr>\n";
$message .= "									<td class=\"content-block\">\n";
$message .= "										<h2>Thanks for the payment.</h2>\n";
$message .= "									</td>\n";
$message .= "								</tr>\n";
$message .= "								<tr>\n";
$message .= "									<td class=\"content-block\">\n";
$message .= "										<table class=\"invoice\">\n";
$message .= "											<tr>\n";
$message .= "												<td>Dear " . $fname . " " . $lname . "<br><br><b>Booking ID #" . $id . "</b><br><br></td>\n";
$message .= "											</tr>\n";
$message .= "											<tr>\n";
$message .= "												<td>\n";
$message .= "													<table class=\"invoice-items\" cellpadding=\"0\" cellspacing=\"0\">\n";
$message .= "														<tr>\n";
$message .= "															<td style=\"width:200px;\">Total</td>\n";
$message .= "															<td  style=\"width:200px;\"> <b>RM" . $total . "</b></td>\n";
$message .= "														</tr>\n";
$message .= "														<tr>\n";
$message .= "															<td style=\"width:200px;\">Deposit Paid</td>\n";
$message .= "															<td  style=\"width:200px;\"><b>RM" . $deposit . "</b></td>\n";
$message .= "														</tr>\n";
$message .= "														<tr>\n";
$message .= "															<td style=\"width:200px;\">Balance</td>\n";
$message .= "															<td  style=\"width:200px;\"><b>RM" . $bal . "</b></td>\n";
$message .= "														</tr>\n";;
$message .= "														\n";
$message .= "													</table>\n";
$message .= "														<br><b><br>Remarks:</b>\n";
$message .= "															<br>\n";
$message .= "															<b>1. Please pay rest of the balance upon check in.</b><br>\n";
$message .= "															<br>\n";
$message .= "															\n";
$message .= "												</td>\n";
$message .= "											</tr>\n";
$message .= "										</table>\n";
$message .= "									</td>\n";
$message .= "								</tr>\n";
$message .= "								<tr>\n";
$message .= "								</tr>\n";
$message .= "								<tr>\n";
$message .= "									<td>\n";
$message .= "										<br><br>Hotel Address, Street Your address, 50450 Kuala Lumpur, Malaysia\n";
$message .= "									</td>\n";
$message .= "								</tr>\n";
$message .= "							</table>\n";
$message .= "						</td>\n";
$message .= "					</tr>\n";
$message .= "				</table>\n";
$message .= "				<div class=\"footer\">\n";
$message .= "					<table width=\"100%\">\n";
$message .= "						<tr>\n";
$message .= "							<td><br>Questions? Email <a href=\"mailto:\">info@hotel.com.my or Call Us at 0000000</a></td>\n";
$message .= "						</tr>\n";
$message .= "					</table>\n";
$message .= "				</div></div>\n";
$message .= "		</td>\n";
$message .= "		<td></td>\n";
$message .= "	</tr>\n";
$message .= "</table></body></html>";
$message = wordwrap($message, 70);
$headers  = "From: admin@hotel.gamboh.com.my";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

// mail($email, $subject, $message, $headers);

header("location: successmessage.php");
