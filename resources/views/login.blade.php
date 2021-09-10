<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Gustov</title>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <link href="{{ asset('frontend') }}/dist/css/auth.css" rel="stylesheet" />
    </head>
    <body class="hold-transition sidebar-mini">
        <div class="container login-container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div class="col-md-6 login-form-1">
                    <h3 class="form-group">Login Restaurant Gustov</h3>
                    <h5 class="text-center"><img alt="" src="{{ asset('frontend') }}/dist/assets/img/gustov.png"  width="100px" height="100px"/> "GUSTOV"</h5>
                    <form action="/login" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Enter Email">
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Enter password">
                        </div>
                        <button type="submit" class="btn btn-primary">Login</button>
                    </form>
                </div>
            </div>
        </div>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    </body>
</html>
