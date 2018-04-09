<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        @include('inc.parts.head')
        <div class="col-md-12">
            @yield('content')
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    {{--<script>--}}
        {{--(function($) {--}}
            {{--$(function() {--}}
                {{--$('ul.tabs__caption').on('click', 'li:not(.active)', function() {--}}
                    {{--$(this)--}}
                        {{--.addClass('active').siblings().removeClass('active')--}}
                        {{--.closest('div.tabs').find('div.tabs__content').removeClass('active').eq($(this).index()).addClass('active');--}}

                    {{--localStorage.setItem("myTabs", this);--}}
                    {{--localStorage.getItem("myTabs");--}}
                    {{--var object = localStorage.getItem("myTabs");--}}

                   {{--console.log(object);--}}
                    {{--// if(){--}}
                    {{--//     $('a[href="' +lastTab+ '"]').click();--}}
                    {{--// }--}}
                    {{--//console.log(lastTab);--}}
                   {{--// window.location.hash = $(this).attr("href");--}}

                    {{--//window.onload = this();--}}
                    {{--// if(window.onload){--}}
                    {{--//     $(this).addClass('active');--}}
                    {{--// }--}}
                    {{--// var oldLocation = location;--}}
                    {{--// location = newLocation;--}}
                    {{--// console.log(location);--}}
                {{--});--}}


            {{--});--}}

            {{--// window.onload = function () {--}}
            {{--//     if('div.tabs__content')--}}
            {{--//     //console.log($('ul.tabs__caption').find('li>a[href="'+window.location.hash+'"]').closest('li').index());--}}
            {{--//     $('ul.tabs__caption li').each(function () {--}}
            {{--//        $(this).removeClass('active');--}}
            {{--//     });--}}
            {{--//     var lastTab = $('ul.tabs__caption').find('li>a[href="'+window.location.hash+'"]').closest('li');--}}
            {{--//     //console.log(lastTab);--}}
            {{--//     var index = $(lastTab).index();--}}
            {{--//     var tab = $(lastTab).attr('data-tab');--}}
            {{--//     $('div.tabs__content').each(function () {--}}
            {{--//         $(this).removeClass('active');--}}
            {{--//     });--}}
            {{--//--}}
            {{--//     $(lastTab).addClass('active');--}}
            {{--//     $('#tabs').find('.tabs__content[data-tab="'+tab +'"]').addClass('active');--}}
            {{--//     //console.log(lastTab);--}}
            {{--// }--}}
            {{--// $(document).ready(function(){--}}
            {{--//     $('ul.tabs__caption').each(function () {--}}
            {{--//         var location = window.location.href;--}}
            {{--//         var link = this.href;--}}
            {{--//         if(location == link) {--}}
            {{--//             $('ul.tabs__caption').addClass('active');--}}
            {{--//         }--}}
            {{--//         //console.log(this);--}}
            {{--//--}}
            {{--//     });--}}


                {{--// $(window).onload( function(){--}}
                {{--//     console.log(this);--}}
                {{--// });--}}

            {{--// });--}}


        {{--})(jQuery);--}}

    {{--</script>--}}

</body>
</html>
