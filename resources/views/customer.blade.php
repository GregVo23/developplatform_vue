<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="author" content="SemiColonWeb" />

    <!-- Stylesheets
    ============================================= -->
    <link href="http://fonts.googleapis.com/css?family=Heebo:300,400,500,700,900" rel="stylesheet" type="text/css" />
    <!--<link rel="stylesheet" href="css/bootstrap.css" type="text/css" />-->
    <link rel="stylesheet" href="css/style.css" type="text/css" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <link rel="stylesheet" href="css/animate.css" type="text/css" />
    <link rel="stylesheet" href="css/custom.css" type="text/css" />

    <!-- Specific Stylesheet -->
    <link rel="stylesheet" href="css/fonts.css" type="text/css" />
    <link rel="stylesheet" href="css/developplatform.css" type="text/css" />

    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="stylesheet" href="css/colors.php?color=f7c25e" type="text/css" />

    <!-- Document Title
    ============================================= -->
    <title>Develop Platform | Designer & Developer réalisent vos projets</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>
<body class="stretched">

    <!-- Document Wrapper
    ============================================= -->
    <div id="wrapper" class="clearfix">

        <!-- Header
        ============================================= -->
        <header id="header" class="border-b-0 no-sticky transparent-header">

            <!--show message
            ============================================= -->
            <x-message/>

            <!--show if errors
            ============================================= -->
            <x-error/>

            <div id="header-wrap">
                <div class="container mx-auto sm:px-4">
                    <div class="header-row px-4 sm:px-0">

                        <!-- Logo
                        ============================================= -->
                        <div id="logo" class="py-2 sm:py-0">
                            <a href="{{ url('/') }}" class="standard-logo"><img src="./images/logo.svg" alt="Logo"></a>
                            <a href="{{ url('/') }}" class="retina-logo"><img src="./images/logo.svg" alt="Logo"></a>
                        </div><!-- #logo end -->

                        <div id="primary-menu-trigger">
                            <svg class="svg-trigger" viewBox="0 0 100 100"><path d="m 30,33 h 40 c 3.722839,0 7.5,3.126468 7.5,8.578427 0,5.451959 -2.727029,8.421573 -7.5,8.421573 h -20"></path><path d="m 30,50 h 40"></path><path d="m 70,67 h -40 c 0,0 -7.5,-0.802118 -7.5,-8.365747 0,-7.563629 7.5,-8.634253 7.5,-8.634253 h 20"></path></svg>
                        </div>

                        <!-- Primary Navigation
                        ============================================= -->
                        <nav class="primary-menu">

                            <ul class="menu-container">
                                <li class="menu-item"><a class="menu-link" href="{{ route('customer') }}"><div>Demandeur</div></a></li>
                                <li class="menu-item"><a class="menu-link" href="{{ route('maker') }}"><div>Réalisateur</div></a></li>
                                <li class="menu-item"><a class="menu-link" href="#" data-scrollto="#footer" data-easing="easeInOutExpo" data-speed="1250" data-offset="70"><div>Contact</div></a></li>
                            <li class="menu-item">
                                @auth
                                <a href="{{ url('/dashboard') }}" class="button button-border rounded-full py-2 px-4">Mon compte</a>
                                @else
                                <a href="{{ route('login') }}" class="button button-border rounded-full py-2 px-4">Connexion</a></li>
                                    @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="button button-border rounded-full py-2 px-4">S'enregistrer</a>
                                    @endif
                                @endauth
                            </ul>

                        </nav><!-- #primary-menu end -->
                    </div>
                </div>
            </div>
        </header><!-- #header end -->
        <body>

<h1>Demandeur de projet</h1>
<p>Vous avez un projet à réaliser ?</p>

            
        </body>
        <!-- Footer
        ============================================= -->
        <footer id="footer" class="border-0" style="background-color: #e5e5e5;">

            <div class="container mx-auto sm:px-4">
                <div class="footer-widgets-wrap  m-0">

                    <div class="flex flex-wrap  justify-between">

                        <div class="md:w-1/3 pr-4 pl-4">
                            <div class="widget">

                                <h3 class="h1 mb-5">Suivez-nous sur nos réseaux sociaux</h3>
                                <span class="text-black-50">Nous sommes actif et postons régulièrement de nouvelles annonces.</span>
                                <div class="flex">
                                    <a href="http://facebook.com/" target="_blank">
                                        <img src="{{ asset('images/facebook.png') }}" alt="facebook logo" class="object-cover h-14"/>
                                    </a>
                                    <a href="http://linkedin.com/" target="_blank">
                                        <img src="{{ asset('images/in.png') }}" alt="linkedin logo" class="object-cover h-14"/>
                                    </a>
                                    <a href="http://twitter.com/" target="_blank">
                                        <img src="{{ asset('images/twitter.png') }}" alt="twitter logo" class="object-cover h-14"/>
                                    </a>
                                    <a href="http://youtube.com/" target="_blank">
                                        <img src="{{ asset('images/youtube.png') }}" alt="youtube logo" class="object-cover h-14"/>
                                    </a>
                                </div>

                            </div>
                            <a href="mailto:info@developplatform" class="h4 text-gray-900 mt-5 mb-4 block"><u>info@developplatform
                                .com</u> <i class="icon-line-arrow-right relative ml-2" style="top: 3px"></i></a>
                            <a class="mt-8 text-sm hover:text-yellow" href="{{ asset(env('APP_URL')."/reglement/reglement.pdf") }}">Mentions légales & réglement d'ordre intérieur</a>
                        </div>
                        <div id="plainte">
                            <div id="contact" class="md:w-2/5 pr-4 pl-4">
                                <form action="{{ route('contact') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-5">
                                        <input id="question" name="question" type="checkbox" value="question" class="focus:ring-yellow h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                        <label class="ml-5 text-sm" for="question">
                                            <p class="text-gray-800">Vous avez une question ?</p>
                                        </label>
                                    </div>
                                    <div class="mb-5">
                                        <input id="complaint" name="complaint" type="checkbox" value="complaint" class="focus:ring-yellow h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                        <label class="ml-5 text-sm" for="complaint">
                                            <p class="text-gray-800">Vous avez une plainte ?</p>
                                        </label>
                                    </div>
                                    <div class="flex flex-wrap  mb-0">
                                        <div class="w-full mb-4">
                                            <label>Votre nom ?</label>
                                            <input type="text" name="name" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded border-form-control required" value="@auth{{ Auth()->user()->firstname ? Auth()->user()->firstname : '' }}  {{ Auth()->user()->lastname ? Auth()->user()->lastname : '' }}@endauth">
                                        </div>
                                        <div class="w-full mb-4">
                                            <label>Votre adresse email ?</label>
                                            <input type="email" name="email" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded border-form-control required" value="@auth{{ Auth()->user()->email ? Auth()->user()->email : '' }}@endauth">
                                        </div>
                                        <div class="w-full mb-4">
                                            <label>Votre question ? Votre plainte ?</label>
                                            <textarea name="texte" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded border-form-control" cols="10" rows="3"></textarea>
                                        </div>
                                        <div class="w-full">
                                            <button type="submit" name="landing-enquiry-submit" class="text-white h-translatey-3 bg-gray-900 rounded-full py-4 px-8 hover:bg-yellow">Envoyer</button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>

                    </div>

                </div>
            </div>

        </footer><!-- #footer end -->

    </div><!-- #wrapper end -->

    <!-- Go To Top
    ============================================= -->
    <div id="gotoTop" class="flex bg-white text-gray-900 rounded-full shadow">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mx-auto mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
        </svg>
    </div>

    <!-- External JavaScripts
    ============================================= -->
    <script src="js/jquery.js"></script>
    <script src="js/plugins.min.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Footer Scripts
    ============================================= -->
    <script src="js/functions.js"></script>

    <script>
        // Owl Carousel Scripts
        jQuery(window).on( 'pluginCarouselReady', function(){
            $('#oc-services').owlCarousel({
                items: 1,
                margin: 30,
                nav: false,
                dots: true,
                smartSpeed: 400,
                responsive:{
                    576: { stagePadding: 30, items: 1 },
                    768: { stagePadding: 30, items: 2 },
                    991: { stagePadding: 150, items: 3 },
                    1200: { stagePadding: 150, items: 3}
                },
            });
        });
    </script>
</body>
</html>
