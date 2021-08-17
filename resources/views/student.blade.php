<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <link rel="stylesheet" href="{{ mix('css/app.css') }}" />
        <script defer src="{{ mix('js/app.js') }}"></script>
    </head>
    <body class="container">
       <div id="app">
        <student />
       </div>
       
    </body>
</html>
