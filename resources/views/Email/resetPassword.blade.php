<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Reset Password</title>
    </head>

    <body style="margin: auto; padding:5px; text-align:center;">
        <h2 style="font-family:'Times New Roman';">Reset Password</h2>

        <p><h4>Click on the button below to reset your password</h4></p>
        <button style="background-color: blue; border:2px; padding:10px; border-radius:5px;">
            <a href="{{$link}}" style="text-decoration: none; font-weight:bolder; color:white;">Reset Password</a>
        </button><br><br>

        <p><h4>Alternatively, copy the link below and paste it in your browser to continue</h4></p>
        <a href="{{$link}}" style="text-decoration: none;">{{$link}}</a>
    </body>

</html>

{{-- @component('mail::message')
# Reset Email

Reset or change your Password
@component('mail::button', ['url' => '/reset_password/.$token'])
Click here
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent --}}
