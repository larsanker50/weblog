<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Opdracht 20: Weblog</title>
    <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
</head>
<body>

    <div id="header">
        @yield ('header')
    </div>
    <br>
    <div id="body">
        @yield ('body')
    </div>

    
</body>
</html>