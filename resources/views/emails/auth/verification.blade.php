<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>Email confirmation.</h2>

        <div>
            <p>Confirm your email address to complete your registration.</p>
            <p><a href="{{ URL::to('register/verify/'.$verificationCode) }}">Confirm now</a></p>
        </div>
    </body>
</html>