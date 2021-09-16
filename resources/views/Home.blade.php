<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <title>Single page forum</title>
</head>
<body>
<div id="app">
    <v-app>
        <app-home></app-home>
    </v-app>
</div>
</body>

<script src="{{ asset('js/app.js') }}"></script>

</html>
