<!DOCTYPE html>
<html lang="eng">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}" />
</head>
<body>
@include('templates.partials.navigation')
<div class="container">
@include('templates.partials.alerts')
@yield('content')
</div>
</body>
</html>