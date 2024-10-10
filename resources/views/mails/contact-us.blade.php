<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contact Us</title>
</head>
<body>
    <div>
        Name: {{ $detail['name'] }}
    </div>
    <div>
        Email: {{ $detail['email'] }}
    </div>
    <div>
        Subject: {{ $detail['subject'] }}
    </div>
    <div>
        Message: {{ $detail['message'] }}
    </div>
</body>
</html>