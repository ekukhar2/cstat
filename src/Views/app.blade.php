<!DOCTYPE html>
<html lang="en">
<head>

    <!-- start: Meta -->
    <meta charset="utf-8">
    <title>Cstat Bootstrap Metro</title>
    <meta name="description" content="Bootstrap Metro Dashboard">
    <meta name="author" content="">
    <meta name="keyword" content="">
    <!-- end: Meta -->

    <!-- start: Mobile Specific -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- end: Mobile Specific -->

    <!-- start: CSS -->
    <link id="bootstrap-style" href="/vendor/cstat/css/bootstrap.min.css" rel="stylesheet">
    <link href="/vendor/cstat/css/bootstrap-responsive.min.css" rel="stylesheet">
    <link id="base-style" href="/vendor/cstat/css/style.css" rel="stylesheet">
    <link id="base-style-responsive" href="/vendor/cstat/css/style-responsive.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&subset=latin,cyrillic-ext,latin-ext' rel='stylesheet' type='text/css'>
    <!-- end: CSS -->


    <!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <link id="ie-style" href="/vendor/cstat/css/ie.css" rel="stylesheet">
    <![endif]-->

    <!--[if IE 9]>
    <link id="ie9style" href="/vendor/cstat/css/ie9.css" rel="stylesheet">
    <![endif]-->

    <!-- start: Favicon -->
    <link rel="shortcut icon" href="/vendor/cstat/img/favicon.ico">
    <!-- end: Favicon -->




</head>

<body>
<!-- start: Header -->
<div class="navbar">
    <div class="navbar-inner">
        <div class="container-fluid">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <a class="brand" href="/cstat"><i class="icon-bar-chart white"></i><span> Cstat</span></a>

            <!-- start: Header Menu -->
            <div class="nav-no-collapse header-nav">
                <ul class="nav pull-right">
                    <li>
                        <a class="btn" href="/">
                            <i class="halflings-icon white home"></i> Home
                        </a>
                    </li>
                    <!-- start: User Dropdown -->
                    @if (Route::has('login'))
                        @if (Auth::check())
                            <li class="dropdown">
                                <a class="btn dropdown-toggle" data-toggle="dropdown" href="/#">
                                    <i class="halflings-icon white user"></i> {{ Auth::user()->name }}
                                </a>
                            </li>
                            <li>
                                <a  class="btn" href="/logout"><i class="halflings-icon white off"></i> Logout</a>
                            </li>
                        @endif
                    @endif

                    <!-- end: User Dropdown -->
                </ul>
            </div>
            <!-- end: Header Menu -->

        </div>
    </div>
</div>
<!-- start: Header -->

<div class="container-fluid">
    <div class="row-fluid">


        <noscript>
            <div class="alert alert-block span10">
                <h4 class="alert-heading">Warning!</h4>
                <p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
            </div>
        </noscript>

        <!-- start: Content -->
        <div id="content" class="span10">



            @yield('content')



        </div><!--/.fluid-container-->

        <!-- end: Content -->
    </div><!--/#content.span10-->
</div><!--/fluid-row-->

<div class="clearfix"></div>

<footer>

    <p>
        <span style="text-align:left;float:left">&copy; 2017 <a href="" alt="Bootstrap_Metro_Cstat">Cstat</a></span>

    </p>

</footer>

<!-- end: JavaScript-->

</body>
</html>
