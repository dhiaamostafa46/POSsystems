<?php

use paylinkPaymentDemo\HttpClient;

require __DIR__ . '/HttpClient.php';
// Beginning of Server side code ************************************************

// Step1: Programmatically generate token from backend server for AppID and Secret Key.
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

        input {
            border: 1px solid skyblue;
            margin-top: 5px;
            margin-bottom: 5px;
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
            <td>Card Number</td>
            <td><input id="card-number" readonly type="text"/></td>
        </tr>
        <tr>
            <td>Card Name</td>
            <td><input id="card-name" readonly type="text"/></td>
        </tr>
        <tr>
            <td>Card Year</td>
            <td><input id="card-year" readonly type="text"/></td>
        </tr>
        <tr>
            <td>Card Month</td>
            <td><input id="card-month" readonly type="text"/></td>
        </tr>
        <tr>
            <td>Card CVV</td>
            <td><input id="card-ccv" readonly type="text"/></td>
        </tr>
    </table>
    <a id="payBtn" href="javascript:payNow()">Pay Now By VISA / MasterCard / MADA</a><br/>
    <br/>
    <a id="payBtn" href="javascript:applePayNow()">Pay Now By ApplePay</a><br/>
</div>

<!-- Step2: Referring to javascript SDK. -->
<script src="paylink.src.js"></script>
<script>

    function successCallback() {
        console.log('success');
    }

    // Step3: Creating Payment javascript object
    let payment = new PaylinkPayments({mode: 'test'});

    async function load() {
        alert('Please wait until we load and initiate the payment form');
        console.log('mode', payment.mode);
        try {
            // Step4: Initiate Payment with HTML elements
            await payment.initPayment('#card-number', '#card-name', '#card-year', '#card-month', '#card-ccv', (error) => {
                alert('payment error' + error);
            });
            alert('payment loaded. You can pay now');
        } catch (error) {
            alert('payment error' + error);
        }
    }

    async function payNow() {
        const token = '<?= $token ?>';
        // Step5: Creating Order javascript object
        let order = new Order({
            callBackUrl: 'http://localhost:6655/processPayment.php', // callback page URL (for example http://localhost:6655 processPayment.php) in your site to be called after payment is processed. (mandatory)
            clientName: 'Zaid Matooq', // the name of the buyer. (mandatory)
            clientMobile: '0509200900', // the mobile of the buyer. (mandatory)
            amount: 111.51, // the total amount of the order (including VAT or discount). (mandatory). NOTE: This amount is used regardless of total amount of products listed below.
            orderNumber: '12301230123', // the order number in your system. (mandatory)
            clientEmail: 'myemail@example.com', // the email of the buyer (optional)
            products: [ // list of products (optional)
                {title: 'Dress 1', price: 120, qty: 2},
                {title: 'Dress 2', price: 120, qty: 2},
                {title: 'Dress 3', price: 70, qty: 2}
            ],
        });

        try {
            // Step 6: Sending the Payment and open the 3DS window
            let response = await payment.sendPayment(token, order);
            console.log('response of send payment is:', response);
            alert('response is: ' + JSON.stringify(response));
        } catch (error) {
            console.log('calling send payment caused error: ', error);
            alert(error.title);
        }

        // Step 7: NOTE: After the payment is processed (either paid or declined), you must from the server side call
        // the endpoint https://restapi.paylink.sa/api/getInvoice/{transactionNo} for production or
        // the endpoint https://restpilot.paylink.sa/api/getInvoice/{transactionNo} for testing
        // to check the invoice status as appear in the processPayment.php example file.
    }

    async function applePayNow() {
        // Step 3: Creating Payment javascript object.
        if (payment.isApplePayAllowed()) {
            const token = '<?= $token ?>';

            // Step 4: In the client side create the order details for the buyer.
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

            // Step 5: Call openPayment function to open the payment popup screen. It takes the generated "token" and the "order" of the buyer.
            await payment.sendApplePay(token, order);

            // Step 6: NOTE: After the payment is processed (either paid or declined), you must from the server side call
            // the endpoint https://restapi.paylink.sa/api/getInvoice/{transactionNo} for production or
            // the endpoint https://restpilot.paylink.sa/api/getInvoice/{transactionNo} for testing
            // to check the invoice status as appear in the processPayment.php example file.

        } else {
            alert('This browser does not support ApplePay. Please use Safari on any Apple Device.');
        }
    }

    window.addEventListener("load", (event) => {
        console.log("page is fully loaded");
        load();
    });

</script>
</body>
</html>
<!-- End of Client Side code -->
