@if (LaravelLocalization::getCurrentLocaleDirection() == 'rtl')
    <style>

        .header__cart{
            float: left;
        }
        @media only screen and (max-width: 998px) {
            .header__cart {
              float: right;
            }
        }
    </style>
@else
    <style>
         .header__cart{
            float: right;
        }
        @media only screen and (max-width: 998px) {
            .header__cart {
                float: left;
            }
        }
    </style>
@endif
