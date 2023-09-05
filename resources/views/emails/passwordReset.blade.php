<!DOCTYPE html>
<html>
<head>
  <title>Reset Password Email</title>
</head>
<body>
  <h1>Reset Password Email</h1>

  <p>Hi {{ $user->name }},</p>

  <p>Your Password Rest Successfull </p>
  <p>
    <strong>New Password : </strong> {{ $password }}
  </p>

</body>
</html>
