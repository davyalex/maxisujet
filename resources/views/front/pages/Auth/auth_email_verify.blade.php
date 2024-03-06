{{-- <h1>Email Verification Mail</h1>

Please verify your email with bellow link:
<a href="{{ route('user.verifyEmail', $token) }}">Verify Email</a> --}}

<h1 style="text-align: center; color: #ff5b09;"><strong>Email de confirmation</strong></h1>
<p style="text-align: center;">Confirmer votre inscription en cliquant sur le lien ci-dessous.</p>
<p style="text-align: center;"><a style="background: rgb(35, 35, 35); color: #ffffff; padding: 10px 50px; border-radius: 3px;"
        href="{{ route('user.verifyEmail', $token) }}">confirmer mon inscription</a></p>
<p style="text-align: center;">&nbsp;</p>
