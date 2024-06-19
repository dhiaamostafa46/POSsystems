<!DOCTYPE html>
<html lang="zxx" @if(session()->get("lang")=="ar") direction="rtl" @endif>

<head>
    <meta charset="UTF-8">
    <meta name="description" content="evix | ايفكس">
    <meta name="keywords" content="مطاعم، مطعم، تسوق، طلب، مشاوي، شاورما">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ايفكس | المطبخ</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{asset('cssECommerce/bootstrap.min.css')}}" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('cssECommerce/elegant-icons.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('cssECommerce/nice-select.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('cssECommerce/jquery-ui.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('cssECommerce/owl.carousel.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('cssECommerce/slicknav.min.css')}}" type="text/css">

    @if (session()->get("lang")=="en")
    <link rel="stylesheet" href="{{asset('cssECommerce/style_en.css')}}" type="text/css">
    @else
    <link rel="stylesheet" href="{{asset('cssECommerce/style.css')}}" type="text/css">
    @endif

    <style>
        .mobile-nav {
            background:#f5f5f5 !important;
            position: fixed !important;
            bottom: 0 !important;
            height: 65px !important;
            width: 100% !important;
            display: flex !important;
            justify-content: space-around !important;
            }
            .bloc-icon {
            display: flex !important;
            justify-content: center !important;
            align-items: center !important;
            }
            .bloc-icon img {
            width: 30px;
            }
            @media screen and (min-width: 600px) {
            .mobile-nav {
            display: none !important;
            }
            }

            @media screen and (max-width: 600px) {
            .header__logo {
            height: 70px;
            width: 60px;
            }

            .header__cart{
                padding: 30px 1px 20px !important;
            }
            .hero__categories{
                display: none !important;
            }
            .hero__item{
                height: 175px !important;
            }
            .hero__text{
                display: none !important;
            }
            .owl-nav{
                margin: auto !important;
            }
            .categories{
                display: none !important;
            }
            .featured{
                padding-top: 0px !important;
            }
            .hero{
                padding-bottom:10px !important;
            }
            .latest-product__text{
                padding-bottom:50px !important;
            }
            .fa-phone{
                padding: 17px !important;
            }
            .fa-shopping-cart, .fa-share-alt, .fa-eye{
                padding: 10px !important;
            }
            .featured__controls{
                margin-bottom: 5px !important;
            }
            .product-details{
                padding-top:10px;
            }
            #basket2 {
                height: 13px;
                width: 13px;
                background: #fb2205;
                font-size: 10px;
                color: #ffffff;
                line-height: 13px;
                text-align: center;
                font-weight: 700;
                display: inline-block;
                border-radius: 50%;
                position: absolute;
                top: 20px;
                margin-left: 15px;
            }
            .latest-product__item__pic{
                width: 60px;
            }
            .latest-product__item__pic img{
                width: 100%;
                max-height: 60px;
            }
            .latest-product{
                padding-top: 10px;
            }
            .featured{
                padding-bottom: 5px;
            }
            .latest-product__text{
                padding-bottom: 5px;
            }
            .set-bg{
                background-size:cover;
            }
            .checkout{
                padding-bottom: 5px;
                padding-top:5px;
            }
            .checkout__order{
                padding-bottom: 70px;
            }
            .latest-product__text h4{
                padding-bottom: 20px;
            }
            
            }
            .latest-product__item__pic{
                width: 60px;
            }
            .latest-product__item__pic img{
                width: 100%;
                max-height: 60px;
            }
            .fa-shopping-cart, .fa-share-alt, .fa-eye{
                padding: 10px !important;
            }
            .nice-select{
                text-align: right !important;
            }

            .nice-select .option{
                text-align: right !important;
            }
    </style>
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    @yield('content')
   
    

    <!-- Js Plugins -->
    <script src="{{asset('jsECommerce/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('jsECommerce/bootstrap.min.js')}}"></script>
    <script src="{{asset('jsECommerce/jquery.nice-select.min.js')}}"></script>
    <script src="{{asset('jsECommerce/jquery-ui.min.js')}}"></script>
    <script src="{{asset('jsECommerce/jquery.slicknav.js')}}"></script>
    <script src="{{asset('jsECommerce/mixitup.min.js')}}"></script>
    <script src="{{asset('jsECommerce/owl.carousel.min.js')}}"></script>
    <script src="{{asset('jsECommerce/main.js')}}"></script>

    <script>
        function addToBasket(id){

            var sName = " ";
            var sum = 0;
            try{
                $('input[type=checkbox]').each(function () {
                sum += (this.checked ? +$(this).data('price') : +0);
                sName += (this.checked ? "+"+$(this).data('name') : "");
                });
            }catch{
                
            }
            
            console.log (sName)

            $('#basket').empty()
            $('#basket2').empty()
            $('#basket3').empty()
                $.ajax({
                    url: `/basket/${document.getElementById('quantity').value}/${id}/${sName}/${sum}`,
                    success: data => {
                            $('#basket').html(data.sum)
                            $('#basket2').html(data.sum)
                            $('#basket3').html(data.sum)
                    }
                });
        }
    </script>

</body>

</html>