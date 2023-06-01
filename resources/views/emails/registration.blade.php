<!DOCTYPE html>
<head>
    <title>Registration Password</title>
</head>
<body>
    <a href="{{ config('app.url') }}/confirm-otp?email={{ $mailData['email'] }}&otp={{ $mailData['password'] }}" target="_blank">Click Me!</a>
</body>

<script>



</script>