<?php
use App\Http\Controllers\HttpClient;

require __DIR__ . '/HttpClient.php';

$transactionNo = $_GET['transactionNo'];
$orderNumber = $_GET['orderNumber'];

$token = HttpClient::login();
$server_response = HttpClient::getRequest('/api/getInvoice/' . $transactionNo, $token);
?>

<?php if ($server_response->orderStatus === 'Declined'): ?>
    Payment for order number <?= $orderNumber ?> has been declined. Please try again.
<?php endif ?>


<?php if ($server_response->orderStatus === 'Paid'): ?>
    Successfully Paid for order number <?= $orderNumber ?>
<?php endif ?>
<br>
<br>

<a href=".">Pay again</a>
