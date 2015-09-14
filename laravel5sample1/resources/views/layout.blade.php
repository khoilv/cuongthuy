<!DOCTYPE Html>
<Html>
    <head>
        <title>
            @section('navigation')
                      Jobeet - Your best job board
            @show
        </title>
        <meta http-equiv="Content-Type" content="text/Html; charset=utf-8" />
        @section('stylesheets')
        {!!Html::style('css/main.css')!!}
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
        @yield('stylesheets')
        @show
        <link rel="shortcut icon" href="images/favicon.ico')" />
        </head>
        <body>
            <div id="container">
                <div id="header">
                    <div class="content">
                        <h1><a href="{!!URL::route('index')!!}">
                                {!! Html::image('images/logo.jpg','Jobeet Job Board') !!}
                            </a></h1>

                        <div id="sub_header">
                            <div class="post">
                                <h2>Ask for people</h2>
                                <div>
                                    <a href="{!!URL::route('create')!!}">Post a Job</a>
                                </div>
                            </div>

                            <div class="search">
                                <h2>Ask for a job</h2>
                                <form action="{!!URL::route('index')!!}" method="get">
                                    <input type="text" name="keywords" id="search_keywords" placeholder="Enter keyword" value=""/>
                                    <input type="submit" value="search" />
                                    <div class="help">
                                        Enter some keywords (city, country, position, ...)
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="content">

                    <div class="content">
                    @yield('content')
                    </div>
                </div>

                <div id="footer">
                    <div class="content">
                        <span class="symfony">
                            {!! Html::image('images/jobeet-mini.png') !!}
                            powered by <a href="http://www.symfony.com/">
                                {!! Html::image('images/symfony.gif', 'symfony framework') !!}
                            </a>
                        </span>
                        <ul>
                            <li><a href="">About Jobeet</a></li>
                            <li class="feed"><a href="">Full feed</a></li>
                            <li><a href="">Jobeet API</a></li>
                            <li class="last"><a href="">Affiliates</a></li>
                        </ul>
                    </div>
                </div>
        </div>
    </body>
</Html>