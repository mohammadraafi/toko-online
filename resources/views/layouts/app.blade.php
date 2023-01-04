<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>@yield('title')</title>

    {{-- Style --}}
    <style>
        .rating-css div {
        color: #ffe400;
        font-size: 30px;
        font-family: sans-serif;
        font-weight: 800;
        text-align: center;
        text-transform: uppercase;
        padding: 20px 0;
      }
      .rating-css input {
        display: none;
      }
      .rating-css input + label {
        font-size: 60px;
        text-shadow: 1px 1px 0 #8f8420;
        cursor: pointer;
      }
      .rating-css input:checked + label ~ label {
        color: #b4afaf;
      }
      .rating-css label:active {
        transform: scale(0.8);
        transition: 0.3s ease;
      }
        </style>
    @stack('prepend-style')
    @include('includes.style')
    @stack('addon-style')
  </head>

  <body>
    <!-- Navigation -->
    @include('includes.navbar')

    <!-- Page Content -->
    @yield('content')

    {{-- footer --}}
    @include('includes.footer')

   {{-- script --}}

   @stack('prepend.script')
   @include('includes.script')
   @include('sweetalert::alert')
   @stack('addon-script')
  </body>
</html>
