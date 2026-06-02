@if(Session::get('dev_mode') == true)
<style>
    .developerbarvma021{
        position: fixed;
        right: 0;
        background-color: #31127a;
        height: 42px;
        z-index: 999;
        bottom: 0;
        padding-top: 6px;
        padding-left: 8px;

    }
    .developerbarvma021 ul li{
        color: white;
        padding: 1px;
        font-size: 12px;
        margin-right: 2px;
        margin-left: 2px;
        float: right;

    }

    .developerbarvma021 ul li span a{
        color: white;
        background-color: #5a22dc;
        padding: 2px 6px;
    }

    .developerbarvma021 ul li span a:hover{
        color: white;
        background-color: #40189d;padding: 8px;
    }

    .af123acsgtqwasd{
        font-weight: 700;
        letter-spacing: -1.1px;
        text-align: center;
        position: absolute;
        left: -2px;
        top: -35px;
        background: #31117a;
        width: 63px;
        height: 35px;
        font-size: 16px !important;
        padding-top: 6px !important;
        border-top-left-radius: 5px;
        border-top-right-radius: 5px;
    }

</style>
<div class="developerbarvma021">
    <ul class="devpanelul" style="margin: 0px !important;">
            <li style="padding-right: 8px;">Version : <span style="color: greenyellow;">2.02</span></li>
        <li> <span><a   href="/optimize/{{Config::get('settings.APP_UUID')}}">Optimize</a></span></li>
        <li> <span ><a target="_black"  href="/system/developer/errorlog">Logs Panel</a></span></li>
        <li> <span><a   target="_black"  href="/system/developer">Developer Panel</a></span></li>
        <li> <span><a   href="/system/developer/view-clear">View Cache Clear</a></span></li>
        <li> <span><a   href="/system/developer/file-clear">File Cache Clear</a></span></li>
        <li> <span><a   href="/system/developer/query-clear">Query Cache Clear</a></span></li>
        <li> <span><a   href="/system/developer/litespeed-clear">Litespeed Cache Clear</a></span></li>
        <li> <span><a   href="/system/developer/session-clear">Session Clear</a></span></li>
        <li class="af123acsgtqwasd">Lego</li>
    </ul>
</div>
@endif
