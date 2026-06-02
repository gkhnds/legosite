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
            <div class="col-md-3">
                <a href="/system/install"><h3>Install</h3><p>You can start the installation from this step!</p></a>
            </div>
            <div class="col-md-3">
                <a href="#"><h3>User Guide</h3><p>how do i use ?</p></a>
            </div>
            <div class="col-md-3">
                <a href="/system/tr/debug"><h3>Webmaster Tools</h3><p>Introduces the data received from the cloud server to the webmaster</p></a>
            </div>
            <div class="col-md-3">
                <a href="#"><h3>Sample</h3><p>You can find sample applications here</p></a>
            </div>

        </div>

    </div>



@endsection
