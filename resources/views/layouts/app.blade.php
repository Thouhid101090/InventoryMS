<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title',env('APP_NAME'))</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{asset('public/assets/vendors/feather/feather.css')}}">
    <link rel="stylesheet" href="{{asset('public/assets/vendors/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/assets/vendors/ti-icons/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('public/assets/vendors/typicons/typicons.css')}}">
    <link rel="stylesheet" href="{{asset('public/assets/vendors/simple-line-icons/css/simple-line-icons.css')}}">
    <link rel="stylesheet" href="{{asset('public/assets/vendors/css/vendor.bundle.base.css')}}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{asset('public/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css')}}">
    <link rel="stylesheet" href="{{asset('public/assets/js/select.dataTables.min.css')}}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{asset('public/assets/css/vertical-layout-light/style.css')}}">
    <link rel="stylesheet" href="{{asset('public/assets/css/style.css')}}">

    <!-- endinject -->
    <link rel="shortcut icon" href="{{asset('public/assets/images/favicon.png')}}" />
    @stack('page-styles')
  </head>

  <body>
    <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->


      @include('dashboard.body.header')

      <div class="container-fluid page-body-wrapper">

        @include('dashboard.body.settings')

        @include('dashboard.body.sidebar')

        <div class="main-panel">
         @yield('content')


      </div>

    </div>
    </div>
    <!-- container-scroller -->

    <!-- plugins:js -->
    <script src="{{asset('public/assets/vendors/js/vendor.bundle.base.js')}}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{asset('public/assets/vendors/chart.js/Chart.min.js')}}"></script>
    <script src="{{asset('public/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('public/assets/vendors/progressbar.js/progressbar.min.js')}}"></script>

    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{asset('public/assets/js/off-canvas.js')}}"></script>
    <script src="{{asset('public/assets/js/hoverable-collapse.js')}}"></script>
    <script src="{{asset('public/assets/js/template.js')}}"></script>
    <script src="{{asset('public/assets/js/settings.js')}}"></script>
    <script src="{{asset('public/assets/js/todolist.js')}}"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="{{asset('public/assets/js/dashboard.js')}}"></script>
    <script src="{{asset('public/assets/js/Chart.roundedBarCharts.js')}}"></script>
    @stack('page-scripts')
    <!-- End custom js for this page-->
    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"/>
    {!! Toastr::message() !!}
  </body>
</html>
