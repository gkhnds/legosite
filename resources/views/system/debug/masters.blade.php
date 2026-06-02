@extends('system.master')

@section('content')

    <style>
        .logo{
            text-align: center;
            padding: 20px;
            padding-top: 60px;
            width: 300px;
            margin: auto;
            position: relative;
        }
        .logo h1{
            font-size: 90px;
            font-weight: 500;
            letter-spacing: -8px;

        }
        .logo h5{
            font-size: 17px;
            color: #a5a5a5;
            word-spacing: 0px;
            font-weight: 500;
            font-style: italic;
        }
        .box{
            padding-top: 40px;
        }
        .box div{
            text-align: center;
        }
        .box div a {
            text-decoration:none;
        }
        .box h4{
            float: left;

        }
        .lang-selection{

            float: right;
            text-align: right !important;
        }
    </style>
    <div class="container">

        <div class="row logo">
            <h1>Lego </h1>
            <h5>UI & UX</h5>
        </div>
        <div class="row box">
            <h4 class="col-md-2">Masters</h4>
            <div class="col-md-8"></div>
          <div class="lang-selection col-md-2">
              <select name="" id="langChangeSelect">
                  @foreach($languages as $lang)
                      <option value="{{$lang->short_name}}" @if(Session::get('developer.lang') == $lang->short_name) selected @endif>{{$lang->name}}</option>
                  @endforeach

              </select>
          </div>
            @dump($masters)
            <div>example : https://www.php.net/manual/language.types.object.php</div>
        </div>

    </div>



@endsection



