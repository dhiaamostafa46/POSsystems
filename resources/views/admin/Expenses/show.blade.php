@extends('layouts.dashboard')

@section('content')
    <link rel="stylesheet" href="{{ asset('Invoce/assets/css/styleln.css') }}">
    <div class="cs-container">
        <div class="cs-invoice cs-style1">
            <div class=" cs-hide_print">
                <a href="javascript:window.print()" class="btn btn-default" style="margin-right: 5px;"><i
                        class="fas fa-print"></i> طباعة</a>
                <button type="button" class="btn btn-primary float-right">
                    <i class="fas fa-download"></i> تحميل PDF
                </button>
            </div>
            <div class="cs-invoice_in" id="download_section">
                <div class="cs-invoice_head cs-type1 cs-mb25">
                    <div class="cs-invoice_left">
                        <div class="cs-logo cs-mb5">
                            @if (!empty(auth()->user()->organization->logo) && auth()->user()->organization->logo != 'default.png')
                                <img src="{{ asset('dist/img/organizations/' . auth()->user()->organization->logo) }}"
                                    width="150px" height="150px" alt="Logo">
                            @endif
                        </div>
                        <!--<div class="cs-logo cs-mb5"><img src="{{ asset('dist/img/logo2.png') }}" alt="Logo"></div>-->

                    </div>
                    <div class="text-center">
                        <p class="cs-invoice_number cs-primary_color cs-mb5 cs-f16"><b class="cs-primary_color">
                                @if ($outcome->type == 2)
                                    فاتورة مصروف
                                @else
                                    مسودة مصروف
                                @endif
                            </b></p>
                       
                        <p class="cs-invoice_date cs-primary_color cs-m0"><b
                                class="cs-primary_color">{{ trans('Sale.Date') }} : </b>{{ $outcome->created_at }} </p>
                    </div>
                    <div class="cs-invoice_right cs-text_right">
                        @if ($outcome->type == 2)
                            <div class="demo" style="display: block;margin-top:2px;"></div>
                        @endif

                        {{-- <div class="cs-logo cs-mb5"><img src="assets/img/logo.svg" alt="Logo"></div> --}}
                    </div>
                </div>


                <div class="cs-invoice_head cs-mb10">
                    <div class="cs-invoice_left">
                        <b class="cs-primary_color"> معلومات المنشاة</b>
                        <p>
                            <span> اسم المنشاة :{{ auth()->user()->organization->nameAr }}</span> <br>
                            <span> {{ trans('Sale.TaxNumber') }} : {{ auth()->user()->organization->vatNo }}</span> <br>
                            <span> {{ trans('Sale.address') }} : {{ auth()->user()->branch->area }} -
                                {{ auth()->user()->branch->city }} - {{ auth()->user()->branch->district }} </span> <br>

                        </p>
                    </div>
                    <div class="cs-invoice_right cs-text_right">
                        <b class="cs-primary_color"> </b>
                        <p>
                            <span>   {{ trans('purchases.Bookinvoicenumber') }}  :{{ $outcome->invoce }} </span> <br>
                            <span>   {{ trans('purchases.Date') }}  :{{ $outcome->date }} </span> <br>
                        </p>
                    </div>
                </div>




                <div class="cs-table cs-style1">
                    <div class="cs-round_border">
                        <div class="cs-table_responsive">
                            <table class="table table-bordered  text-center">
                                <thead>
                                    <tr>
                                        <th class=" cs-semi_bold cs-primary_color cs-focus_bg">
                                            {{ trans('Sandat.Expenseitem') }} </th>
                                        <th class=" cs-semi_bold cs-primary_color cs-focus_bg">
                                            {{ trans('purchases.Quantity') }}</th>
                                        <th class=" cs-semi_bold cs-primary_color cs-focus_bg">
                                            {{ trans('purchases.price') }} </th>
                                        <th class=" cs-semi_bold cs-primary_color cs-focus_bg">
                                            {{ trans('purchases.comment') }} </th>
                                        <th class=" cs-semi_bold cs-primary_color cs-focus_bg">
                                            {{ trans('purchases.Total') }}</th>

                                    </tr>

                                </thead>
                                <tbody>
                                    @if (count($outcome->ExpensDetails) > 0)
                                        @foreach ($outcome->ExpensDetails as $item)
                                            <tr>
                                                <td style="font-size: large;width:30vw">{{ $item->category->nameAr ?? '' }}
                                                </td>
                                                <td style="font-size: large">{{ $item->Quantity }}</td>
                                                <td style="font-size: large">{{ $item->price }}</td>
                                                <td style="font-size: large">{{ $item->comment }}</td>
                                                <td style="font-size: large">{{ number_format($item->total, 2) }}</td>

                                            </tr>
                                        @endforeach
                                    @endif

                                </tbody>
                            </table>
                        </div>
                        <div class="cs-invoice_footer cs-border_top">
                            <div class="cs-left_footer ">
                                {{-- <p class="cs-mb0"><b class="cs-primary_color">Additional Information:</b></p>
                    <p class="cs-m0">At check in you may need to present the credit <br>card used for payment of this ticket.</p> --}}
                            </div>
                            <div class="cs-right_footer">
                                <table class="table table-bordered text-center">
                                    <tbody>
                                        <tr class="cs-border_left">
                                            <td class="cs-width_2 cs-semi_bold cs-primary_color cs-focus_bg">
                                                {{ trans('Sale.total') }} </td>
                                            <td class="cs-width_2 cs-semi_bold cs-focus_bg cs-primary_color cs-text_right">
                                                {{ number_format($outcome->total - $outcome->vat, 2) }}
                                                {{ trans('Sale.Rial') }} </td>
                                        </tr>
                                        <tr class="cs-border_left">
                                            <td class="cs-width_2 cs-semi_bold cs-primary_color cs-focus_bg">
                                                {{ trans('Sale.Valueaddedtax') }}</td>
                                            <td class="cs-width_2 cs-semi_bold cs-focus_bg cs-primary_color cs-text_right">
                                                {{ number_format($outcome->vat, 2) }} {{ trans('Sale.Rial') }} </td>
                                        </tr>


                                        <tr class="cs-border_left">
                                            <td class="cs-width_2 cs-border_top_0 cs-bold cs-f16 cs-primary_color">
                                                {{ trans('Sale.Totalincludingtax') }} </td>
                                            <td
                                                class="cs-width_2 cs-border_top_0 cs-bold cs-f16 cs-primary_color cs-text_right">
                                                {{ number_format($outcome->total, 2) }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="cs-note">
                   <img src="{{asset('public/dist/img/outcomes/'. $outcome->file)}}" alt="">

                </div><!-- .cs-note -->
            </div>

        </div>
    </div>

    <input type="hidden" id="bill_date" value="{{ $outcome->date }}">
    <input type="hidden" id="bill_total" value="{{ $outcome->vat }}">
    <input type="hidden" id="tax_total" value="{{ $outcome->total }}">
    <!-- Description -->
    <input type="hidden" id="seller" value="{{ auth()->user()->organization->nameAr }}">
    <input type="hidden" id="vatNo" value="{{ auth()->user()->organization->vatNo }}">
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"
        integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous">
    </script>
    <script src="{{ asset('dist/jquery-qrcode.js') }}"></script>
    <script>
        var Base64 = {
            _keyStr: "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",
            encode: function(e) {
                var t = "";
                var n, r, i, s, o, u, a;
                var f = 0;
                e = Base64._utf8_encode(e);
                while (f < e.length) {
                    n = e.charCodeAt(f++);
                    r = e.charCodeAt(f++);
                    i = e.charCodeAt(f++);
                    s = n >> 2;
                    o = (n & 3) << 4 | r >> 4;
                    u = (r & 15) << 2 | i >> 6;
                    a = i & 63;
                    if (isNaN(r)) {
                        u = a = 64
                    } else if (isNaN(i)) {
                        a = 64
                    }
                    t = t + this._keyStr.charAt(s) + this._keyStr.charAt(o) + this._keyStr.charAt(u) + this._keyStr
                        .charAt(a)
                }
                return t
            },
            decode: function(e) {
                var t = "";
                var n, r, i;
                var s, o, u, a;
                var f = 0;
                e = e.replace(/[^A-Za-z0-9\+\/\=]/g, "");
                while (f < e.length) {
                    s = this._keyStr.indexOf(e.charAt(f++));
                    o = this._keyStr.indexOf(e.charAt(f++));
                    u = this._keyStr.indexOf(e.charAt(f++));
                    a = this._keyStr.indexOf(e.charAt(f++));
                    n = s << 2 | o >> 4;
                    r = (o & 15) << 4 | u >> 2;
                    i = (u & 3) << 6 | a;
                    t = t + String.fromCharCode(n);
                    if (u != 64) {
                        t = t + String.fromCharCode(r)
                    }
                    if (a != 64) {
                        t = t + String.fromCharCode(i)
                    }
                }
                t = Base64._utf8_decode(t);
                return t
            },
            _utf8_encode: function(e) {
                e = e.replace(/\r\n/g, "\n");
                var t = "";
                for (var n = 0; n < e.length; n++) {
                    var r = e.charCodeAt(n);
                    if (r < 128) {
                        t += String.fromCharCode(r)
                    } else if (r > 127 && r < 2048) {
                        t += String.fromCharCode(r >> 6 | 192);
                        t += String.fromCharCode(r & 63 | 128)
                    } else {
                        t += String.fromCharCode(r >> 12 | 224);
                        t += String.fromCharCode(r >> 6 & 63 | 128);
                        t += String.fromCharCode(r & 63 | 128)
                    }
                }
                return t
            },
            _utf8_decode: function(e) {
                var t = "";
                var n = 0;
                var r = c1 = c2 = 0;
                while (n < e.length) {
                    r = e.charCodeAt(n);
                    if (r < 128) {
                        t += String.fromCharCode(r);
                        n++
                    } else if (r > 191 && r < 224) {
                        c2 = e.charCodeAt(n + 1);
                        t += String.fromCharCode((r & 31) << 6 | c2 & 63);
                        n += 2
                    } else {
                        c2 = e.charCodeAt(n + 1);
                        c3 = e.charCodeAt(n + 2);
                        t += String.fromCharCode((r & 15) << 12 | (c2 & 63) << 6 | c3 & 63);
                        n += 3
                    }
                }
                return t
            }
        }

        function decimalToHexString(number) {
            if (number < 0) {
                number = 0xFFFFFFFF + number + 1;
            }

            return number.toString(16).toUpperCase();
        }

        function hex_to_ascii(str1) {
            var hex = str1.toString();
            var str = '';
            for (var n = 0; n < hex.length; n += 2) {
                str += String.fromCharCode(parseInt(hex.substr(n, 2), 16));
            }
            return str;
        }

        function tlv(tag, svalue) {
            var sLength = new TextEncoder().encode(svalue).length;
            var hexSTag = tag.toString(16);
            var hexSLength = sLength.toString(16);
            return hex_to_ascii(hexSTag) + hex_to_ascii(hexSLength) + String(svalue);
        }

        $(".demo").qrcode({
            size: 90,
            fill: '#333',
            text: Base64.encode(tlv(1, document.getElementById('seller').value) + tlv(2, document.getElementById(
                'vatNo').value) + tlv(3, document.getElementById('bill_date').value) + tlv(4, document
                .getElementById('bill_total').value) + tlv(5, document.getElementById('tax_total').value)),
            mode: 3,
            //label: 'elite fitness',
            fontcolor: '#000',
        });
        $("canvas").css({
            border: 'solid white',
            width: "120px"
        });
    </script>

@endsection
