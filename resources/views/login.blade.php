<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
        <title>ADMIN | Panel </title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> 

        <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
    </head>
    <body>
        <div class="login container" style="margin-top: 15px;">
             <div class="card">
                 <div class="card-header">
                    <div class="title">
                        login
                    </div>
                    </div>
    
                    <div class="form-body">
                        @if($errors->any())
                            <div class="alert alert-danger">Email\Password Errors</div>
                        @endif

                    <form action="/login" method="post">
                       <div class="form-group">
                         <label for="email">Email</label>
                         <input type="text" id="email" name="email" class="form-control">
                     </div>
                    <div class="form-group">
                         <label for="password">Password</label>
                         <input type="password" id="password" name="password" class="form-control">
                     </div>  
                       @csrf
                     <input type="submit" class="btn btn-success" value="submit">
                    
                    </form>
                 </div>
             </div>
        </div>
        <script src="/bootstrap/js/bootstrap.min.js"></script>
    </body>
</html>
