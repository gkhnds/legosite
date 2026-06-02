@extends('theme.master')

@section('title', __('payment.Cart'))

@section('meta')
    <title>{{__('payment.Cart')}}</title>


@endsection

@section('content')

    <style>
        .paymentBox{
        padding: 140px;
            text-align: center;
        }
        .paymentBox i{
            font-size: 60px;
        }
        .paymentBox h5{
            color:#b80000;
            font-weight: 600;
        }
    </style>
    <div class="container">
     <div class="row">
         <div class="col-md-3"></div>
         <div class="col-md-6">
             <div class="paymentBox">
                 <img style="width: 100px;" src="/resources/views/extra/cart/assets/check.png" alt="">
                 <br>
                 <h3 style="color:#4dbbeb;"> {{$response->message}}</h3>
                 <h4 style="color: black;font-size: 13px; line-height: 20px;">Sipariş Numaranız</h4>
                 <h5 style="color: #f97924;">({{$response->order_number}})</h5>
             </div>


         </div>
         <div class="col-md-3"></div>
     </div>
    </div>


@endsection
