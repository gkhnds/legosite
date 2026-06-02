<html>
<head></head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat+Alternates:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap');
    body {
        color: #000000;
        font-family: 'Montserrat Alternates', sans-serif;
        background-color: #ffffff;
    }
    table thead,
    table tfoot
    {
        background-color: #f3f3f3;
    }
    tbody, td, tfoot, th, thead, tr
    {
        border-color: inherit;
        border-style: solid;
        border-width: 0;
    }
    table thead > tr th,
    table tfoot > tr th
    {
        color: #000000;
        font-size: 15px;
        font-weight: 500;
        text-transform: uppercase;
        padding: 14px 23px 14px;
    }

    table thead > tr th.width-thumbnail
    {
        min-width: 130px;
    }

    table thead > tr th.width-name
    {
        min-width: 350px;
    }

    table thead > tr th.width-price {
        min-width: 103px;
    }

    table thead > tr th.width-quantity {
        min-width: 100px;
    }
    table thead > tr th.width-subtotal {
        min-width: 145px;
    }
    table tbody tr {
        border-bottom: 4px solid #f3f3f3;
    }

    table tbody > tr td:first-child
    {
        text-align: left;
    }
    table
    {
        width: 100%;
        margin-bottom: 30px;
    }

    table.form-bilgileri tbody > tr td:first-child
    {
        min-width: 100px;
    }

    table.form-bilgileri tbody > tr td:last-child
    {
        width: 90%;
    }

    table.teslimat-bilgileri tbody > tr td:first-child
    {
        width: 20%;
    }

    table.teslimat-bilgileri tbody > tr td:last-child
    {
        width: 80%;
    }

    table.teslimat-bilgileri tbody > tr td,
    table.form-bilgileri tbody > tr td
    {
        padding: 10px;
        text-align: left;
    }

    table tbody > tr td
    {
        padding: 23px;
        text-align: center;
    }

    table tbody > tr td.product-name h5,
    table tbody > tr td
    {
        font-size: 15px;
        color: #000000;
        font-weight: 600;
    }
    table tbody > tr td.product-name h5 a
    {
        color: #000000;
    }

    .baslik
    {
        background-color: #f5f5f5;
        padding: 5px;
    }
</style>
<body>
        <table class="form-bilgileri">
            <thead>
                <tr>
                    <th colspan="5"></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{$translate->mailsystem_name}} : </td>
                    <td>{{$isim}}</td>
                </tr>



                <tr>
                    <td>{{$translate->mailsystem_email}} : </td>
                    <td>{{$email}}</td>
                </tr>

                <tr>
                    <td>{{$translate->indirim_kodunuz}} : </td>
                    <td><b>{{$email}}</b></td>
                </tr>

                <tr>
                    <td>{{$translate->mailsystem_message}} : </td>
                    <td>{!! $DiscountCode !!}</td>
                </tr>
            </tbody>
        </table>
</body>
</html>
