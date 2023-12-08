<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>mailinformation</title>
</head>
<body>
    <div class="container" style="width: 50%; margin: auto; color: #353b48; padding: 10px; border: 1px solid #353b48; border-radius: 10px;">
        <h1 style="font-weight: bold;">Hello I am, <br/> {{ $maillername }}</h1>
        <p><b>Subject:</b> {{ $maillersubject }}.</p>
        <p>{{ $maillermessage }}</p>
    </div>
</body>
</html>
