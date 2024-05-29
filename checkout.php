<!-- Razorpay Main Code -->
<!-- Shifted most of this code to reservationcomplete.php -->
<!-- this file is useful reference only -->
<?php
session_start();

require('config.php');
require('vendor/autoload.php');

use Razorpay\Api\Api;

if (!empty($_POST['amount'])) {

    $amount = $_POST['amount'];
    $name = "test";
    $email = "test@test";
    $bookingId = $_POST['booking_id'];

    $api = new Api($keyId, $keySecret);

    $orderData = [
        'receipt'         => $bookingId,
        'amount'          => $amount * 100, // 39900 rupees in paise
        'currency'        => $displayCurrency
    ];

    $razorpayOrder = $api->order->create($orderData);

    if (!empty($razorpayOrder['id'])) {
        $_SESSION['order_id'] = $razorpayOrder['id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment Form</title>
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
            background-color: #f2f2f2;
        }
        .form-wrapper {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            text-align: center;
        }
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
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        function openRazorpayCheckout() {
            var options = {
                "key": "<?php echo $keyId; ?>",
                "amount": "<?php echo $amount; ?>",
                "currency": "<?php echo $displayCurrency; ?>",
                "name": "<?php echo $companyName; ?>",
                "description": "Lalat Resort Booking Web App",
                "image": "", // Optionally add your company logo URL here
                "order_id": "<?php echo $razorpayOrder['id']; ?>",
                "handler": function (response){
                    document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
                    document.getElementById('razorpay_order_id').value = response.razorpay_order_id;
                    document.getElementById('razorpay_signature').value = response.razorpay_signature;
                    document.getElementById('paymentForm').submit();
                },
                "prefill": {
                    "name": "<?php echo $name; ?>",
                    "email": "<?php echo $email; ?>"
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
<body>
    <div class="container">
        <div class="form-wrapper">
            <form id="paymentForm" action="<?php echo $baseURL; ?>/success.php" method="POST">
                <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
                <input type="hidden" name="razorpay_order_id" id="razorpay_order_id">
                <input type="hidden" name="razorpay_signature" id="razorpay_signature">
                <button type="button" class="pay-button" onclick="openRazorpayCheckout()">Pay <?php echo $amount; ?> with Razorpay</button>
            </form>
        </div>
    </div>
</body>
</html>

<?php
    }
}
?>