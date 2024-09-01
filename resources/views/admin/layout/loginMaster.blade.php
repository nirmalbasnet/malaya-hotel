<!DOCTYPE html>
<html>
<head>
    <title>Malaya Holidays || Nepal</title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Rentonnepal">
    <meta name="author" content="Rentonnepal">
    <meta name="copyright" content="Rentonnepal">

    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('public/favicon.png')}}">

    <!-- stylesheet start -->
    <link href="{{asset('public/admin/dist/css/style.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('public/admin/custom/login.css')}}">

    <!-- Google fonts -->

    <link href="https://fonts.googleapis.com/css?family=Lato:400,400i,700,700i,900,900i" rel="stylesheet">
</head>
<body>
@yield('main-body')
@yield('scripts')

<script src="{{asset('public/admin/assets/libs/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('public/admin/assets/libs/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{asset('public/admin/custom/login.js')}}"></script>
</body>
</html>
