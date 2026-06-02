

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
    </style>
    <div class="container">

        <div class="row logo">
            <h1>Lego </h1>
            <h5>UI & UX</h5>
        </div>
        <div class="row box">
            <h4>Translations</h4>
            @if(count((array)$translations) > 0)
                @dump($translations);
                <div>example : https://www.php.net/manual/language.types.object.php</div>
            @else
                <div style="text-align: left">
                    Panelde [translate] adında master bileşeni açıp [tag] ve [text] sutunu tanımlandıktan sonra kullanılabilir.
                    proje içerisinde $translations->{tag} olarak çağrılabilmektedir.
                </div>
            @endif



        </div>

    </div>



@endsection






