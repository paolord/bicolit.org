<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="utf-8" />
        <!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>@yield('meta_title', Config::get('app.default_title'))</title>
        <meta name="keywords" content="@yield('meta_keywords', Config::get('app.default_keywords'))" />
        <meta name="author" content="@yield('meta_author', Config::get('app.default_author'))" />
        <!-- Google will often use this as its description of your page/site. Make it good. -->
        <meta name="description" content="@yield('meta_description', Config::get('app.default_description'))" />

        <!-- Dublin Core Metadata : http://dublincore.org/ -->
        <meta name="DC.title" content="@yield('meta_title', Config::get('app.default_title'))">
        <meta name="DC.subject" content="@yield('meta_description', Config::get('app.default_description'))">
        <meta name="DC.creator" content="@yield('meta_author', Config::get('app.default_author'))">

        <!--  Mobile Viewport Fix -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

        <!-- This is the traditional favicon.
         - size: 16x16 or 32x32
         - transparency is OK
         - see wikipedia for info on browser support: http://mky.be/favicon/ -->
        <link rel="shortcut icon" href="{{{ asset('assets/ico/favicon.png') }}}">

        <!-- iOS favicons. -->
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{{ asset('assets/ico/apple-touch-icon-144-precomposed.png') }}}">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{{ asset('assets/ico/apple-touch-icon-114-precomposed.png') }}}">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{{ asset('assets/ico/apple-touch-icon-72-precomposed.png') }}}">
        <link rel="apple-touch-icon-precomposed" href="{{{ asset('assets/ico/apple-touch-icon-57-precomposed.png') }}}">

        <!-- CSS -->
        {{ Basset::show('admin.css') }}

        <style>
        .tab-pane {
            padding-top: 20px;
        }
        </style>

        @yield('styles')

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

        <!-- Asynchronous google analytics; this is the official snippet.
         Replace UA-XXXXXX-XX with your site's ID and uncomment to enable.
        <script type="text/javascript">
            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', 'UA-31122385-3']);
            _gaq.push(['_trackPageview']);

            (function() {
                var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
                    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
            })();

        </script> -->

    </head>

    <body>
        <!-- Container -->
        <div class="container">

            <!-- Notifications -->
            @include('notifications')
            <!-- ./ notifications -->

            <div class="page-header">
                <h3>
                    {{ $title }}
                    <div class="pull-right">
                        <button class="btn btn-default btn-small btn-inverse close_popup"><span class="glyphicon glyphicon-circle-arrow-left"></span> Back</button>
                    </div>
                </h3>
            </div>

            <!-- Content -->
            @yield('content')
            <!-- ./ content -->

            <!-- Footer -->
            <footer class="clearfix">
                @yield('footer')
            </footer>
            <!-- ./ Footer -->

        </div>
        <!-- ./ container -->

        <!-- Javascripts -->
        {{ Basset::show('admin.js') }}

        <script type="text/javascript">
            $(document).ready(function(){
                $('.close_popup').click(function(){
                    parent.oTable.fnReloadAjax();
                    parent.$.colorbox.close();
                    return false;
                });

                $('.form-delete').submit(function(event) {
                    $('#loading').show();
                    var form = $(this);
                    for (instance in CKEDITOR.instances) {
                        CKEDITOR.instances[instance].updateElement();
                    }

                    $.ajax({
                        type: form.attr('method'),
                        url: form.attr('action'),
                        data: form.serialize()
                    }).done(function() {
                        $('#loading').hide();
                        parent.jQuery.colorbox.close();
                        parent.oTable.fnReloadAjax();
                    }).fail(function() {
                    });
                    event.preventDefault();
                });

                $('.nav-tabs a:first').tab('show');
            });

            $(prettyPrint);

        </script>

        @yield('scripts')

    </body>

</html>
