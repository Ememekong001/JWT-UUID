<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ResetPassword</title>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
               <div class="card">
                    <div class="card-header">Reset Password</div>
                         <div class="card-body">
                             <form method="POST" action="{{url = '/reset_password'}}">
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

</body>
</html>
