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

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                                    </div>
                                    <form method="POST" action="{{ route('register') }}">
                                        @csrf
                                        <!-- Name -->
                                        <div class="form-group">
                                            <label for="name">{{ __('Name') }}</label>
                                            <input id="name" class="form-control" type="text" name="name"
                                                value="{{ old('name') }}" required autofocus autocomplete="name" />
                                            @if ($errors->has('name'))
                                            <div class="text-danger mt-2">
                                                {{ $errors->first('name') }}
                                            </div>
                                            @endif
                                        </div>

                                        <!-- Email Address -->
                                        <div class="form-group mt-4">
                                            <label for="email">{{ __('Email') }}</label>
                                            <input id="email" class="form-control" type="email" name="email"
                                                value="{{ old('email') }}" required autocomplete="username" />
                                            @if ($errors->has('email'))
                                            <div class="text-danger mt-2">
                                                {{ $errors->first('email') }}
                                            </div>
                                            @endif
                                        </div>

                                        <!-- Password -->
                                        <div class="form-group mt-4">
                                            <label for="password">{{ __('Password') }}</label>
                                            <input id="password" class="form-control" type="password" name="password"
                                                required autocomplete="new-password" />
                                            @if ($errors->has('password'))
                                            <div class="text-danger mt-2">
                                                {{ $errors->first('password') }}
                                            </div>
                                            @endif
                                        </div>

                                        <!-- Confirm Password -->
                                        <div class="form-group mt-4">
                                            <label for="password_confirmation">{{ __('Confirm Password') }}</label>
                                            <input id="password_confirmation" class="form-control" type="password"
                                                name="password_confirmation" required autocomplete="new-password" />
                                            @if ($errors->has('password_confirmation'))
                                            <div class="text-danger mt-2">
                                                {{ $errors->first('password_confirmation') }}
                                            </div>
                                            @endif
                                        </div>

                                        <div class="flex items-center justify-end mt-4">
                                            <button type="submit" class="btn btn-primary ms-4">
                                                {{ __('Register') }}
                                            </button>
                                        </div>

                                    </form>
                                    <hr>

                                    @if (Route::has('register'))
                                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                        href="{{ route('login') }}">
                                        {{ __('Already registered?') }}
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

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