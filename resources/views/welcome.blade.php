<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>OIL India Limited</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
   
    <link href="https://oilspe.cbtexamportal.in/assests/images/favicon.ico" rel="shortcut icon" />
    <link href="https://oilspe.cbtexamportal.in/assests/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://oilspe.cbtexamportal.in/assests/css/jquery-ui.min.css" rel="stylesheet">
    <link href="https://oilspe.cbtexamportal.in/assests/css/all.min.css" rel="stylesheet">
    <link href="https://oilspe.cbtexamportal.in/assests/css/style.css" rel="stylesheet" />
    <script src="https://oilspe.cbtexamportal.in/assests/js/config.js"></script>
    <script src="https://oilspe.cbtexamportal.in/assests/js/jquery-1.8.3.min.js"></script>
    <script src="https://oilspe.cbtexamportal.in/assests/js/jquery-ui.min.js"></script>
       <script src="https://oilspe.cbtexamportal.in/assests/js/custom-validations.js"></script>
    <script src="https://oilspe.cbtexamportal.in/assests/js/custom-functions.js"></script>


</head>

<body>

    <header class="header">
        <div class="ajax-loader ajax-busy-wrap" style="display:none">loading</div>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="logo"><img src="https://oilspe.cbtexamportal.in//assests/images/logo.png" /></div>
                </div>
                <div class="col-sm-4 vcenter">
                    <div class="headerTitle"> OIL INDIA LIMITED : Recruitment For Various Posts<br>
                        <span class=""><strong>POST CODE </strong> - SPE 01</span>
                    </div>
                </div>
                <div class="col-sm-5 vbottom">
                    <nav id="customStyleNav" class="navbar navbar-expand-lg p-0">
                        <div class="container-fluid">
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation"> <span
                                    class="navbar-toggler-icon"></span> </button>
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav ms-auto">
                                    <li class="nav-item"> <a class="nav-link" href="https://oilspe.cbtexamportal.in/"><i
                                                class="fa-solid fa-house"></i> Home</a> </li>
                                    <li class="nav-item"> <a class="nav-link"
                                            href="https://oilspe.cbtexamportal.in/View/important-date"><i
                                                class="fa-solid fa-calendar-days"></i> Important Dates</a> </li>
                                    </li>
                                  
                                    @if (Route::has('login'))
                                        @auth
                                        <a href="{{ url('/home') }}"
                                            class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Home</a>
                                        @else
                                                <li class="nav-item"><a class="nav-link" href="{{ route('login') }}"><i
                                                class="fa-solid fa-right-to-bracket"></i>Login</a> </li>

                                        @if (Route::has('register'))
                                        <li class="nav-item"><a class="nav-link" href="{{ route('register') }}"><i
                                                class="fa-solid fa-right-to-bracket"></i>Register</a> </li>
                                        @endif
                                        @endauth
                                    
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <section class="noteText">
        <div class="container">
            <div class="row">
                <div class="col-12 m-auto">
                    <div class="card customCard">
                        <div class="card-header customHeader"> Note: </div>
                        <div class="card-body">
                            <ol>

                                <li>You are advised to fill all the required fields in the registration form.</li>
                                <li>
                                    You are advised to refer to the advertisement for the eligibility criteria viz.
                                    educational
                                    qualification, age limit etc. before filling up the application form.<a href="#"
                                        target="_blank">(Download Advertisement)</a>
                                </li>
                                <li>Strongly recommended: Use the updated versions of Google Chrome and Firefox browsers
                                    for filling out the application form.</li>
                                <li>For upload of documents/certificates/testimonials in the format/size: PDF, Maximum 1
                                    MB.</li>
                                <li>For upload of passport-sized photograph in the format/size: JPG or PNG, Maximum 200
                                    KB.</li>
                                <li>For upload of signature in the format/size: JPG or PNG, Maximum 200 KB.</li>
                                <li>After the Submit button clicked, you will be redirected to the application form.
                                </li>
                                <li>You can check your application form/submission status by logging in with the
                                    credentials sent on your registered E-mail ID.</li>
                                <li>Download and Retain a copy of online application form for future use.</li>
                                <li>For any queries/support -&nbsp;<a href="https://oilindia.smartexams.in/index.php"
                                        target="_blank">click here</a></li>
                                <li>You can also reach on 07969049943.</li>
                                <li>Help Desk will be avaliable 9:30 AM to 6:00 PM including(Saturday/Sunday)</li>
                            </ol>

                        </div>
                    </div>


                </div>
            </div>
        </div>

    </section>
    
    <script src="https://oilspe.cbtexamportal.in//assests/js/bootstrap.bundle.min.js"></script>
</body>

</html>