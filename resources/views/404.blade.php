<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Task Management System - Register</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('theme/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('theme/css/sb-admin-2.min.css') }}" rel="stylesheet">

</head>

<body class="bg-gradient-primary">
    <div class="container-fluid d-flex align-items-center justify-content-center vh-100 bg-gradient-primary">
        <div class="text-center text-white">
            <h1 class="display-1 font-weight-bold" data-text="404">404</h1>
            <h2 class="lead mb-4">Oops! Page Not Found</h2>
            <p class="text-gray-300 mb-4">It seems we can’t find the page you’re looking for.</p>
            <p class="text-gray-300 mb-5">Try checking the URL for typos or go back to the homepage.</p>
            <a href="{{ route('tasks.index') }}" class="btn btn-light btn-lg">&larr; Back to Dashboard</a>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('theme/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('theme/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('theme/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('theme/js/sb-admin-2.min.js') }}"></script>

</body>

</html>