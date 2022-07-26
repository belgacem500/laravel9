<!DOCTYPE html>
<html lang="en">
<head>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <title></title>

        <!-- GOOGLE FONTS -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500|Poppins:400,500,600,700|Roboto:400,500" rel="stylesheet"/>
        <link href="https://cdn.materialdesignicons.com/3.0.39/css/materialdesignicons.min.css" rel="stylesheet" />

        <!-- PLUGINS CSS STYLE -->
        <link href="{{asset('backend/assets/plugins/toaster/toastr.min.css')}}" rel="stylesheet" />
        <link href="{{asset('backend/assets/plugins/nprogress/nprogress.css')}}" rel="stylesheet" />
        <link href="{{asset('backend/assets/plugins/flag-icons/css/flag-icon.min.css')}}" rel="stylesheet"/>
        <link href="{{asset('backend/assets/plugins/jvectormap/jquery-jvectormap-2.0.3.css')}}" rel="stylesheet" />
        <link href="{{asset('backend/assets/plugins/ladda/ladda.min.css')}}" rel="stylesheet" />
        <link href="{{asset('backend/assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet" />
        <link href="{{asset('backend/assets/plugins/daterangepicker/daterangepicker.css')}}" rel="stylesheet" />


        <!-- SLEEK CSS -->
        <link id="sleek-css" rel="stylesheet" href="{{asset('backend/assets/css/sleek.css')}}" />



        <!-- FAVICON -->
        <link href="{{  asset('backend/assets/img/favicon.png')  }}" rel="shortcut icon" />

        <!--
          HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries
        -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script src="{{  asset('assets/plugins/nprogress/nprogress.js')  }}"></script>
    </head>

</head>
<body class="bg-light-gray" id="body">
<div class="container d-flex flex-column justify-content-between vh-100">
    <div class="row justify-content-center mt-5">
        <div class="col-xl-5 col-lg-6 col-md-10">
            <div class="card">
                <div class="card-header bg-primary">
                    <div class="app-brand">
                        <a href="/index.html">
                            <svg class="brand-icon" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" width="30" height="33"
                                 viewBox="0 0 30 33">
                                <g fill="none" fill-rule="evenodd">
                                    <path class="logo-fill-blue" fill="#7DBCFF" d="M0 4v25l8 4V0zM22 4v25l8 4V0z" />
                                    <path class="logo-fill-white" fill="#FFF" d="M11 4v25l8 4V0z" />
                                </g>
                            </svg>
                            <span class="brand-name">BlaGo Dashboard</span>
                        </a>
                    </div>
                </div>
                <div class="card-body p-5">

                    <x-jet-validation-errors class="mb-4 p-3 alert-danger" />


                    @if (session('status'))
                        <div class="mb-3 font-medium text-sm text-green-600">
                            {{ session('status') }}                        </div>
                    @endif

                    <h4 class="text-dark mb-4">Verify Your Email</h4>
                    Before continuing, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-12 mb-4 mt-4">
                                <input type="email" class="form-control input-lg" name="email" aria-describedby="emailHelp" placeholder="email" required autofocus>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn  btn-primary">Resend Verification Email</button>
                                <a href="{{ route('profile.show') }}" class="ml-3 ">Edit Profile </a>
                            </div>

                        </div>
                    </form>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class=" btn btn-dark btn-block mt-4">
                            Log Out
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright pl-0">
        <p class="text-center">&copy;Copyright BlaGo Coding
            <a class="text-primary" href="#" target="_blank">BlaGo</a>.
        </p>
    </div>
</div>
</body>
</html>
