<!-- Razorpay Main Code -->
<?php
session_start();

require('config.php');

use Razorpay\Api\Api;

if (!empty($_POST['amount'])) {

    $amount = $_POST['amount'];
    $name = "test";
    $email = "test@test";

    $api = new Api($keyId, $keySecret);

    $orderData = [
        'receipt'         => 'rcptid_11',
        'amount'          => $amount, // 39900 rupees in paise
        'currency'        => $displayCurrency
    ];

    $razorpayOrder = $api->order->create($orderData);

    if (!empty($razorpayOrder['id'])) {
        $_SESSION['order_id'] = $razorpayOrder['id'];
?>
        <!-- Hetlai hi a page hi edit rawh -->
        <form action="<?php echo $baseURL; ?>/success.php" method="POST">
            <script src="https://checkout.razorpay.com/v1/checkout.js" data-key="<?php echo $keyId; ?>" data-amount="<?php echo $amount; ?>" data-currency="<?php echo $displayCurrency; ?>" data-order_id="<?php echo $razorpayOrder['id']; ?>" data-buttontext="Pay <?php echo $amount; ?> with Razorpay" data-name="<?php echo $companyName; ?>" data-description="Lalat Resort Booking Web App" data-image="" data-prefill.name="<?php echo $name; ?>" data-prefill.email="<?php echo $email; ?>" data-theme.color="#F37254"></script>
            <input type="hidden" custom="Hidden Element" name="hidden" />
        </form>
<?php
    }
}
?>