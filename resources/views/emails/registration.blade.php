<!DOCTYPE html>
<head>
    <title>Registration Password</title>
</head>
<body>
    <a href="{{ config('app.url') }}/confirm-email?email={{ $mailData['email'] }}&otp={{ $mailData['password'] }}" target="_blank">Click Me!</a>
</body>

<script>



</script>