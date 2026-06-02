<style>
    @import url("https://fonts.googleapis.com/css?family=Josefin+Sans:700&display=swap");
    :root {
        --dark: #333;
        --light: #fff;
        --neutral: #f6f6f6;
        --neutral-dark: #d1d1d1;
        --color: {{$masters->tasarim_ayarlari->data->dynamic->color2}};
        --color-light: #941ed2;
        --color-dark: #2719cd;
        --font-stack: "Josefin Sans", "Montserrat", "sans-serif";
    }

    @media only screen and (max-width: 768px) {
        .menu__body{
            display: block !important;
            --x: 0;
            --y: 0;
            --z: 0;
            width: 100%;
            background: var(--light);
            padding-bottom: 5px;
            padding-top: 5px;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            box-shadow: 0px -9px 50px -30px black;
            font-family: "Montserrat", sans-serif;
            position: fixed;
            bottom: 0;
            z-index: 105;
            transform: translate3d(var(--x), var(--y), var(--z));
            transition: 0.2s cubic-bezier(0.33, 1, 0.53, 1);
        }
    }

    .hero__wrapper {
        display: flex;
        align-items: flex-end;
        justify-content: center;
        flex-wrap: wrap;
    }
    .hero__wrapper:before {
        content: "";
        width: 150px;
        height: 150px;
        background: linear-gradient(135deg, var(--color-light), var(--color-dark));
        border-radius: 50%;
        position: fixed;
        bottom: 50px;
        left: 10px;
        z-index: -1;
    }
    .hero__wrapper > * {
        margin: 15px;
    }

    .hero__header {
        flex: 0 1 1px;
        padding-right: 50px;
        color: var(--dark);
        font-size: 8vmax;
    }

    .hero__phone {
        width: 300px;
        height: 630px;
        background: var(--light);
        background-color: #ffffff;
        background: #fff url("https://codepenworldsfair.com/images/small-worlds-fair.png") center/250px no-repeat;
        border: 12px solid var(--dark);
        border-radius: 36px;
        position: relative;
        overflow: hidden;
    }
    .hero__phone:before {
        content: "";
        width: 175px;
        height: 25px;
        background: var(--dark);
        border-bottom-right-radius: 20px;
        border-bottom-left-radius: 20px;
        position: absolute;
        top: 0;
        left: 50%;
        transform: translatex(-50%);
        z-index: 1000;
    }
    .hero__phone:after {
        content: "";
        width: 100px;
        height: 5px;
        background: var(--dark);
        border-radius: 2px;
        position: absolute;
        bottom: 6px;
        left: 50%;
        transform: translatex(-50%);
        z-index: 1000;
    }

    .menu__button {
        --x: -50%;
        --y: 0;
        --z: 0;
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: linear-gradient(to right, var(--color-light), var(--color-dark));
        padding: 10px 20px;
        border-radius: 28px;
        box-shadow: 0 2px 40px -10px var(--color);
        color: var(--light);
        font-size: 16px;
        white-space: nowrap;
        position: absolute;
        bottom: 30px;
        left: 50%;
        transform: translate3d(var(--x), var(--y), var(--z));
        cursor: pointer;
        z-index: 105;
        transition: 0.15s cubic-bezier(0.33, 1, 0.53, 1);
    }
    .menu__button[hidden] {
        --y: 200%;
    }
    .menu__button div {
        display: flex;
        align-items: center;
        width: 12px;
        height: 12px;
        margin-right: 20px;
    }
    .menu__button div div {
        display: table;
        height: 1px;
        background: var(--light);
        box-shadow: 0 4px 0 var(--light), 0 -4px 0 var(--light);
    }

    .menu__overlay {
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.1);
        position: absolute;
        z-index: 100;
    }

    .menu__body {
        display: none;
    }
    .menu__body[hidden] {
        --y: 150%;
    }
    .menu__body > *:not(:last-child) {
        /* border-bottom: 2px solid var(--neutral);*/
    }

    .menu__header {
        display: flex;
        justify-content: space-between;
        padding: 15px 20px;
    }
    .menu__header label div {
        width: 15px;
        height: 15px;
        border: 2px solid var(--dark);
        border-radius: 50%;
        position: relative;
        transform: rotate(5.5rad);
    }
    .menu__header label div:after {
        content: "";
        width: 2px;
        height: 10px;
        background: var(--dark);
        position: absolute;
        top: 100%;
        left: 50%;
        transform: translateX(-50%);
    }
    .menu__header p {
        font-size: 18px;
        font-weight: bold;
        vertical-align: center;
        white-space: nowrap;
    }
    .menu__header h3 {
        font-weight: normal;
    }
    .menu__header button {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 25px;
        height: 25px;
        background: var(--neutral-dark);
        border-radius: 50%;
        cursor: pointer;
    }
    .menu__header button div {
        width: 15px;
        height: 3px;
        background: var(--light);
        position: relative;
        transform: rotate(5.5rad);
    }
    .menu__header button div:before {
        content: "";
        width: 3px;
        height: 15px;
        background: var(--light);
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }


    .menu__links a {
        flex: 1 1 1px;
        padding: 10px 8px;
        color: var(--dark);
        text-decoration: none;
        white-space: nowrap;
    }

    .menu__contact {
        display: flex;

    }
    .menu__contact svg {
        width: 100%;
        fill: var(--color);
    }
    .menu__contact a {
        flex: 1 1 30%;

        margin: 5px;
        border-radius: 8px;
        background: var(--neutral);
        color: var(--color);
        text-align: center;
        font-size: 14px;
        font-weight: bold;
    }
</style>

<section class="menu__body">

    <div class="menu__contact">

        <a href="tel:{{$masters->iletisim->data->dynamic->telefon}}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="#000000" height="24" viewbox="0 0 24 24" width="24">
                <path d="M0 0h24v24H0z" fill="none"></path>
                <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"></path>
            </svg><span>{{$translate->telefon}}</span>
        </a>

        <a href="mailto:{{$masters->iletisim->data->dynamic->email}}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="#000000" height="24" viewbox="0 0 24 24" width="24">
                <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"></path>
                <path d="M0 0h24v24H0z" fill="none"></path>
            </svg><span>{{$translate->email}}</span>
        </a>

        <a href="https://wa.me/{{ $masters->iletisim->data->dynamic->whatsapp }}?text={{ $masters->iletisim->data->dynamic->whatsapp_mesaj }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16"> <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"/> </svg>
            <span>{{$translate->whatsapp_title}}</span>
        </a>

    </div>

</section>
<div class="menu__overlay" hidden="hidden"></div>
