<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    <title>{{env('APP_NAME')}}</title>
</head>
<body style="background-color: #e2e8f0">
    <div id="app">
        <app></app>
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>