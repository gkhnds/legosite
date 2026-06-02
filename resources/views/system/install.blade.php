<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
<style>
.form-group{
    margin-bottom: 1rem;
}

</style>
<br><br>
<div class="container">
    <div class="row">
        <div style="text-align: center;" class="col-md-12">
            <h1>Setup Wizard</h1>
        </div>
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <form action="/system/install" method="POST">
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">Server Addres</label> <small id="emailHelp" class="form-text text-muted">Api Server Connection Url.</small>
                    <input type="text" class="form-control" name="SERVER_ADDRESS" value="" required>

                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">App Uuid</label><small id="emailHelp" class="form-text text-muted"> Application's unique key.</small>
                    <input type="text" class="form-control" name="APP_UUID" value="" required>

                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Username/Email</label>
                    <input type="text" class="form-control" name="DEVELOPER_USERNAME" value="" required>

                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Password</label>
                    <input type="text" class="form-control" name="DEVELOPER_PASSWORD" value="" required>

                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Secure Mode</label> <small id="emailHelp" class="form-text text-muted">Ssl / Tls Redict.</small>
                    <select name="SECURE_STATUS" class="form-control" id="">
                        <option value="1">True</option>
                        <option value="0">False</option>
                    </select>

                </div>




                <div class="input">
                    <input type="submit" class="btn btn-primary" value="Install App">
                </div>

            </form>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>

</body>
</html>
