<?php

use paylinkPaymentDemo\HttpClient;

require __DIR__ . '/HttpClient.php';
// Beginning of Server side code ************************************************

// 1) Programmatically generate token from backend server for AppID and Secret Key.
$token = HttpClient::login();
// End of Server side code ************************************************
?>

<!-- Beginning of Client Side code -->

<html lang="en">
<head>
    <title>Merchant Demo for Paylink Payment javascript SDK v3.</title>
    <style>
        * {
            font-family: Chalkboard, monospace;
        }
    </style>
</head>
<body>
<p>Welcome to Merchant Demo for Paylink Payment STCPay javascript SDK.</p>

<table border="1">
    <tr>
        <td>clientName</td>
        <td>Zaid Matooq</td>
    </tr>
    <tr>
        <td>
            clientMobile
        </td>
        <td>
            920022174
        </td>
    </tr>

    <tr>
        <td>
            amount
        </td>
        <td>
            5
        </td>
    </tr>
    <tr>
        <td>
            orderNumber
        </td>
        <td>
            12301230123
        </td>
    </tr>
    <tr>
        <td>
            clientEmail
        </td>
        <td>
            myemail@example.com
        </td>
    </tr>
    <tr>
        <td>
            products
        </td>
        <td>
            <table border="1">
                <tr>
                    <td>
                        title
                    </td>
                    <td>
                        price
                    </td>
                    <td>
                        qty
                    </td>
                </tr>
                <tr>
                    <td>
                        Dress 1
                    </td>
                    <td>
                        120
                    </td>
                    <td>
                        2
                    </td>
                </tr>
                <tr>
                    <td>
                        Dress 2
                    </td>
                    <td>
                        120
                    </td>
                    <td>
                        2
                    </td>
                </tr>
                <tr>
                    <td>
                        Dress 3
                    </td>
                    <td>
                        70
                    </td>
                    <td>
                        1
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>

<div id="paymentData"></div>

<div style="margin: 15px">
    <table>
        <tr>
            <td>STCPay Mobile Country Code</td>
            <td><input placeholder="966" id="country-code" type="text"/></td>
        </tr>
        <tr>
            <td>STCPay Mobile</td>
            <td><input placeholder="5XXXXXXXX" id="mobile" type="text"/></td>
        </tr>
        <tr>
            <td>
                <button id="payBtn" onclick="sendOtp()">Send OTP By STCPay</button>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td><span class="text-danger" id="server-msg"></span></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>STCPay Mobile OTP</td>
            <td><input placeholder="XXXXXX" id="otp" type="text"/></td>
        </tr>
        <tr>
            <td>
                <button id="payBtn" onclick="payNow()">Pay Now By STCPay</button>
            </td>
        </tr>
    </table>
</div>

<!-- Step 2: Refer to paylink.js SDK library file in https://paylink.sa/assets/js/paylink.js -->
<script src="paylink.src.js"></script>
<script>

    // Step 3: Creating Payment javascript object
    let payment = new PaylinkPayments({mode: 'dev'});
    let msg = document.getElementById('server-msg');

    async function sendOtp() {
        const token = '<?= $token ?>';
        const mobileCountryCode = document.getElementById('country-code').value;
        const mobile = document.getElementById('mobile').value;

        // Step 4: Creating Order javascript object
        let order = new Order({
            callBackUrl: 'http://localhost:6655/processPayment.php', // callback page URL (for example http://localhost:6655 processPayment.php) in your site to be called after payment is processed. (mandatory)
            clientName: 'Zaid Matooq', // the name of the buyer. (mandatory)
            clientMobile: '0509200900', // the mobile of the buyer. (mandatory)
            amount: 5, // the total amount of the order (including VAT or discount). (mandatory). NOTE: This amount is used regardless of total amount of products listed below.
            orderNumber: '12301230123', // the order number in your system. (mandatory)
            clientEmail: 'myemail@example.com', // the email of the buyer (optional)
            products: [ // list of products (optional)
                {title: 'Dress 1', price: 120, qty: 2},
                {title: 'Dress 2', price: 120, qty: 2},
                {title: 'Dress 3', price: 70, qty: 2}
            ],
        });

        msg.innerHTML = "Sending OTP ... Please wait"

        // Step 5: Send OTP to STCPay client phone
        let stcpayOtpResponse = await payment.sendStcPayOtp(token, order, mobileCountryCode, mobile);

        msg.innerHTML = "OTP Sent. Please Enter the OTP now.";

        sessionStorage.setItem('stcpayOtpResponse', JSON.stringify(stcpayOtpResponse));
    }

    async function payNow() {
        const otp = document.getElementById('otp').value;
        let stcpayOtpResponse = JSON.parse(sessionStorage.getItem('stcpayOtpResponse'));

        msg.innerHTML = "Processing STCPay Payment.";
        // Step 6) Call processStcPayPayment function to process STCPay payment.
        let stcpayPaymentResponse = await payment.processStcPayPayment(otp, stcpayOtpResponse);

        msg.innerHTML = "STCPay payment process has been completed. "
        alert('Paid order number is: ' + stcpayPaymentResponse.transactionNo);

        // 7) NOTE: After the payment is processed (either paid or declined), you must from the server side call
        // the endpoint https://restapi.paylink.sa/api/getInvoice/{transactionNo} for production or
        // the endpoint https://restpilot.paylink.sa/api/getInvoice/{transactionNo} for testing
        // to check the invoice status as appear in the processPayment.php example file.
    }
</script>
</body>
</html>
<!-- End of Client Side code -->
