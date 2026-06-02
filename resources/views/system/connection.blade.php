<!doctype html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://knockoutjs.com/downloads/knockout-3.5.1.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Roboto:700');
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #FFD399;
        }
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: row;
            margin: 0 auto;
            width: 50%;
        }
        @keyframes rotate {
            0% {
                transform: rotateX(-37.5deg) rotateY(45deg);
            }
            50% {
                transform: rotateX(-37.5deg) rotateY(405deg);
            }
            100% {
                transform: rotateX(-37.5deg) rotateY(405deg);
            }
        }
        .cube, .cube * {
            position: absolute;
            width: 151px;
            height: 151px;
        }
        .sides {
            animation: rotate 3s ease infinite;
            animation-delay: 0.8s;
            transform-style: preserve-3d;
            transform: rotateX(-37.5deg) rotateY(45deg);
        }
        .cube .sides * {
            box-sizing: border-box;
            background-color: rgba(242, 119, 119, 0.5);
            border: 15px solid white;
        }
        .cube .sides .top {
            animation: top-animation 3s ease infinite;
            animation-delay: 0ms;
            transform: rotateX(90deg) translateZ(150px);
            animation-fill-mode: forwards;
            transform-origin: 50% 50%;
        }
        @keyframes top-animation {
            0% {
                opacity: 1;
                transform: rotateX(90deg) translateZ(150px);
            }
            20% {
                opacity: 1;
                transform: rotateX(90deg) translateZ(75px);
            }
            70% {
                opacity: 1;
                transform: rotateX(90deg) translateZ(75px);
            }
            90% {
                opacity: 1;
                transform: rotateX(90deg) translateZ(150px);
            }
            100% {
                opacity: 1;
                transform: rotateX(90deg) translateZ(150px);
            }
        }
        .cube .sides .bottom {
            animation: bottom-animation 3s ease infinite;
            animation-delay: 0ms;
            transform: rotateX(-90deg) translateZ(150px);
            animation-fill-mode: forwards;
            transform-origin: 50% 50%;
        }
        @keyframes bottom-animation {
            0% {
                opacity: 1;
                transform: rotateX(-90deg) translateZ(150px);
            }
            20% {
                opacity: 1;
                transform: rotateX(-90deg) translateZ(75px);
            }
            70% {
                opacity: 1;
                transform: rotateX(-90deg) translateZ(75px);
            }
            90% {
                opacity: 1;
                transform: rotateX(-90deg) translateZ(150px);
            }
            100% {
                opacity: 1;
                transform: rotateX(-90deg) translateZ(150px);
            }
        }
        .cube .sides .front {
            animation: front-animation 3s ease infinite;
            animation-delay: 100ms;
            transform: rotateY(0deg) translateZ(150px);
            animation-fill-mode: forwards;
            transform-origin: 50% 50%;
        }
        @keyframes front-animation {
            0% {
                opacity: 1;
                transform: rotateY(0deg) translateZ(150px);
            }
            20% {
                opacity: 1;
                transform: rotateY(0deg) translateZ(75px);
            }
            70% {
                opacity: 1;
                transform: rotateY(0deg) translateZ(75px);
            }
            90% {
                opacity: 1;
                transform: rotateY(0deg) translateZ(150px);
            }
            100% {
                opacity: 1;
                transform: rotateY(0deg) translateZ(150px);
            }
        }
        .cube .sides .back {
            animation: back-animation 3s ease infinite;
            animation-delay: 100ms;
            transform: rotateY(-180deg) translateZ(150px);
            animation-fill-mode: forwards;
            transform-origin: 50% 50%;
        }
        @keyframes back-animation {
            0% {
                opacity: 1;
                transform: rotateY(-180deg) translateZ(150px);
            }
            20% {
                opacity: 1;
                transform: rotateY(-180deg) translateZ(75px);
            }
            70% {
                opacity: 1;
                transform: rotateY(-180deg) translateZ(75px);
            }
            90% {
                opacity: 1;
                transform: rotateY(-180deg) translateZ(150px);
            }
            100% {
                opacity: 1;
                transform: rotateY(-180deg) translateZ(150px);
            }
        }
        .cube .sides .left {
            animation: left-animation 3s ease infinite;
            animation-delay: 100ms;
            transform: rotateY(-90deg) translateZ(150px);
            animation-fill-mode: forwards;
            transform-origin: 50% 50%;
        }
        @keyframes left-animation {
            0% {
                opacity: 1;
                transform: rotateY(-90deg) translateZ(150px);
            }
            20% {
                opacity: 1;
                transform: rotateY(-90deg) translateZ(75px);
            }
            70% {
                opacity: 1;
                transform: rotateY(-90deg) translateZ(75px);
            }
            90% {
                opacity: 1;
                transform: rotateY(-90deg) translateZ(150px);
            }
            100% {
                opacity: 1;
                transform: rotateY(-90deg) translateZ(150px);
            }
        }
        .cube .sides .right {
            animation: right-animation 3s ease infinite;
            animation-delay: 100ms;
            transform: rotateY(90deg) translateZ(150px);
            animation-fill-mode: forwards;
            transform-origin: 50% 50%;
        }
        @keyframes right-animation {
            0% {
                opacity: 1;
                transform: rotateY(90deg) translateZ(150px);
            }
            20% {
                opacity: 1;
                transform: rotateY(90deg) translateZ(75px);
            }
            70% {
                opacity: 1;
                transform: rotateY(90deg) translateZ(75px);
            }
            90% {
                opacity: 1;
                transform: rotateY(90deg) translateZ(150px);
            }
            100% {
                opacity: 1;
                transform: rotateY(90deg) translateZ(150px);
            }
        }
        .text {
            margin-top: 450px;
            color: #f27777;
            font-size: 1.5rem;
            width: 100%;
            font-weight: 600;
            text-align: center;
        }

    </style>
</head>
<body>

<div class="container" style="height: 100vh;">
    <div class="cube">
        <div class="sides">
            <div class="top"></div>
            <div class="right"></div>
            <div class="bottom"></div>
            <div class="left"></div>
            <div class="front"></div>
            <div class="back"></div>
        </div>
    </div>
    <div class="text">Lütfen Bekleyin</div>
</div>


<script>
    let interval = null;
    $('document').ready(function () {
        interval = setInterval(updateDiv,100);
    });
    function updateDiv(){
        $.ajax({
            url: "{{Config::get('settings.SERVER_ADDRESS')}}/api/ServerConnectionControl",
            type: "GET",
            cache: false,
            success: function(response){
                if (response.status == true){
                    clearInterval(interval);
                    $(location).attr('href', '/');
                }
            }
        });
    }

</script>



</body>
</html>
