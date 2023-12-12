<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
           <!-- Font Icon -->
    <link rel="stylesheet" href="{{asset('public/auth/fonts/material-icon/css/material-design-iconic-font.min.css')}}">

    <!-- Main css -->
    <link rel="stylesheet" href="{{asset('public/auth/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('public/assets/css/style.css')}}">
       @stack('styles')
    </head>
    <body>
   
     
      @yield('content')
    
       
       
    </body>
    
    <!-- JS -->
    <script src="{{asset('public/auth/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('public/auth/js/main.js')}}"></script>
    
 
</html>
