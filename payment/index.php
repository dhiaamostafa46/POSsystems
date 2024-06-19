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
    <title>Merchant Demo for Paylink Payment javascript SDK.</title>
    <style>
        * {
            font-family: Chalkboard, monospace;
        }
    </style>
</head>
<body>
<p>Welcome to Merchant Demo for Paylink Payment javascript SDK.</p>

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
            0509200900
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

<div style="margin: 15px">
    <button id="payBtn" onclick="payNow()">Pay Now By VISA / MasterCard / MADA</button>
    <br/>
    <br/>
    <button id="applePayBtn" onclick="applePayNow()">Pay Now By ApplePay</button>
</div>

<div style="margin: 15px">
    <a href="embeddedjs.php">Check Example of Embedded JS SDK</a><br/>
    <br/>
    <a href="stcpayjs.php">Check Example of STCPay JS SDK</a>
</div>

<!-- 2) Refer to paylink.js SDK library file in https://paylink.sa/assets/js/paylink.js -->
<script src="./paylink.src.js"></script>
<script>

    function successCallback() {
        console.log('success');
    }

    let payment = new PaylinkPayments({mode: 'dev', defaultLang: 'ar', backgroundColor: '#EEE'});

    function payNow() {
        // 3) Send the generated token value to client side.
        const token = '<?= $token ?>';

        // 4) In the client side create the order details for the buyer.
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

        // 6) Call openPayment function to open the payment popup screen. It takes the generated "token" and the "order" of the buyer.
        payment.openPayment(token, order, successCallback);

        // 7) NOTE: After the payment is processed (either paid or declined), you must from the server side call
        // the endpoint https://restapi.paylink.sa/api/getInvoice/{transactionNo} for production or
        // the endpoint https://restpilot.paylink.sa/api/getInvoice/{transactionNo} for testing
        // to check the invoice status as appear in the processPayment.php example file.
    }

    function applePayNow() {
        // 4) Check if the current browser support apple pay.
        if (payment.isApplePayAllowed()) {
            // 5) Send the generated token value to client side.
            const token = '<?= $token ?>';

            // 6) In the client side create the order details for the buyer.
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

            // 7) Call openPayment function to open the payment popup screen. It takes the generated "token" and the "order" of the buyer.
            payment.openApplePay(token, order, successCallback);

            // 8) NOTE: After the payment is processed (either paid or declined), you must from the server side call
            // the endpoint https://restapi.paylink.sa/api/getInvoice/{transactionNo} for production or
            // the endpoint https://restpilot.paylink.sa/api/getInvoice/{transactionNo} for testing
            // to check the invoice status as appear in the processPayment.php example file.
        } else {
            alert('This browser does not support ApplePay. Please use Safari on any Apple Device.');
        }
    }


</script>
</body>
</html>
<!-- End of Client Side code -->
