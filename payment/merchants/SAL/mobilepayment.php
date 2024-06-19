<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <style>
        body {
            background-color: #dedede;
        }

        .header {
            background: white;
            height: 78px;
            width: 100%;
            margin: 0;
            max-width: inherit;
            border-bottom: 10px solid transparent;
            padding: 15px;
            border-image: url(./img/sal-header-border.png) 10 repeat;
        }

        .title {
            font-weight: bold;
            color: red;
            display: block;
            font-size: 16pt;
            margin-top: auto;
            margin-bottom: auto;
        }

        .apple-pay-btn {
            filter: invert(1);
        }

        .apple-pay-btn:hover {
            filter: invert(0)
        }

        .arrow {
            width: 12px;
            margin: auto 16px;
            font-weight: bold;
            min-width: 12px;
        }

        .payment-form {
            min-width: 250px;
            margin: 20px auto;
            background-color: #f2f2f2;
            border-radius: 15px;
            /*max-width: 350px;*/
        }

        .button {
            margin: auto 0;
            padding: 10px;
        }

        .stcpay-btn button {
            background-color: #4f008c;
            margin-top: 10px;
        }

        .stcpay-btn button:hover {
            background-color: #4f008c91;
            margin-top: 10px;
        }

        .pay-btn button {
            background-color: #eb0a29;
            margin-top: 10px;
            padding: 5px;
            font-weight: bolder;
        }

        .pay-btn button:hover {
            background-color: #eb0a2985;
            margin-top: 10px;
        }

        .card-body {
            background: #f2f2f2;
            border-radius: 15px;
        }

        .orpaywithcard {
            margin-top: 10px;
        }

        .orpaywithcard span {
            position: relative; /* needed for absolute positioning */
            display: inline-block; /* to allow width and height settings */
            padding: 0 10px; /* adjust as needed */
        }

        .orpaywithcard span::before,
        .orpaywithcard span::after {
            content: "";
            position: absolute;
            bottom: 0;
            width: 50%; /* adjust as needed */
            height: 1px;
            background-color: black; /* change to desired color */
        }

        input.form-control {
            border: solid 1px #0aaf62;
        }

        .line {
            content: "";
            position: relative;
            margin: auto 0;
            width: 50%; /* adjust as needed */
            height: 1px;
            background-color: black; /* change to desired color */
        }

        .orpaywithcard span::before {
            left: 0;
        }

        .orpaywithcard span::after {
            right: 0;
        }
    </style>
</head>
<body>
<div class='header container d-flex flex-row'>
    <div class='arrow bg-white'>
        <svg viewBox="0 0 94.464 168.782" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <bx:grid x="0" y="0" width="98.768" height="168.782"/>
            </defs>
            <rect width="256" height="256" fill="none" y="55.831" x="62.839"/>
            <polyline points="84.733 12.46 12.733 84.46 84.733 156.46" stroke-linecap="round" stroke-linejoin="round" stroke-width="24" fill="none" style="stroke: rgb(255, 0, 0);"/>
        </svg>
    </div>
    <div class='title'>
        General Invoice
    </div>
</div>
<div class='body'>
    <div class='payment-form card'>
        <div class='card-body d-flex flex-column shadow-lg'>
            <div class='apple-pay-btn d-flex flex-column'>
                <button class='bg-white text-white btn btn-dark rounded button'>
                    <img src='img/applepay.svg' width='50' style="color: #0a53be"/>
                </button>
            </div>
            <div class='stcpay-btn d-flex flex-column'>
                <button class='text-white btn btn-white rounded button'>
                    <img src='img/stcpay.svg' width='50' style="color: #0a53be"/>
                </button>
            </div>
            <div class='orpaywithcard d-flex flex-row'>
                <p style='width:100%' class='line'>&nbsp;</p>
                <p style="white-space: nowrap;width:100%;margin: auto 5px;text-align: center">Or pay with card</p>
                <p style='width:100%' class='line'>&nbsp;</p>
            </div>
            <div class="mb-2">
                <label for="cardNumber" class="form-label">Card Number <span class='text-danger'>*</span></label>
                <input type="number" class="form-control" id="cardNumber" placeholder="XXXX XXXX XXXX XXXX">
            </div>
            <div class="mb-2">
                <label for="cardName" class="form-label">Name On Card <span class='text-danger'>*</span></label>
                <input type="number" class="form-control" id="cardName" placeholder="FName LName">
            </div>
            <div class='d-flex flex-row'>
                <div class="mb-2 mr-2">
                    <label for="expMM" class="form-label">MM <span class='text-danger'>*</span></label>
                    <input type="number" class="form-control" id="expMM" placeholder="Exp MM">
                </div>
                <div class="mb-2 mx-2">
                    <label for="expYY" class="form-label">YY <span class='text-danger'>*</span></label>
                    <input type="number" class="form-control" id="expYY" placeholder="Exp YY">
                </div>
                <div class="mb-2 ml-2">
                    <label for="cvv" class="form-label">CVV <span class='text-danger'>*</span></label>
                    <input type="number" class="form-control" id="cvv" placeholder="XXX">
                </div>
            </div>
            <div class='d-flex flex-row justify-content-between my-3'>
                <div>Total</div>
                <div style="font-weight: bolder" class='text-danger'>75.00 SAR</div>
            </div>
            <div class='pay-btn d-flex flex-column'>
                <button class='text-white btn rounded button'>
                    Pay 75.00 SAR
                </button>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>
