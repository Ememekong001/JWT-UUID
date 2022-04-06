<!doctype html>
<html lang="en">
  <head>
    <title>Reset Password</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                   <div class="card">
                        <div class="card-header">Reset Password</div>
                             <div class="card-body">
                                 <form method="POST" action="{{url('/reset_password')}}">
                                  @csrf
                                  <input type="hidden" name="token" value="{{$token}}">
                               <div class="form-group row">
                                   <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                                 <div class="col-md-6">
                                       <input id="email" type="email" class="form-control" name="email" value="{{ $email ?? old('email') }}" autocomplete="email" autofocus>
                                       @if ($errors->has('email'))
                                           <span class="text-danger">{{ $errors->first('email') }}</span>
                                       @endif
                                   </div>
                               </div>

                               <div class="form-group row">
                                   <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                                   <div class="col-md-6">
                                       <input id="password" type="password" class="form-control" name="password" autocomplete="new-password">
                                       @if ($errors->has('password'))
                                           <span class="text-danger">{{ $errors->first('password') }}</span>
                                       @endif
                                   </div>

                               </div>

                             <div class="form-group row">
                                   <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>
                                   <div class="col-md-6">
                                       <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                                   </div>
                               </div>

                            <div class="form-group row mb-0">
                                  <div class="col-md-6 offset-md-4">
                                       <button type="submit" class="btn btn-primary">
                                           Reset Password
                                       </button>
                                   </div>
                               </div>
                           </form>
                       </div>
                   </div>
               </div>
           </div>
       </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>

