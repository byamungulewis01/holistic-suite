<!DOCTYPE html>
<html>
<head>
  <title>Email Verification</title>
</head>
<body>
  <h1>Verify Your Email Address</h1>

  <p>Hi {{ $member->name }},</p>

  <p>Thank you for creating an account with us. Don't forget to complete your registration!</p>
  <p>
    Your Account Verification Code is <strong>{{ $verification_code }}</strong>
  </p>
  <br>

  <p>If you did not create an account, please ignore this email.</p>

</body>
</html>
