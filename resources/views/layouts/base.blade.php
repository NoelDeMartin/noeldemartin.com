<!DOCTYPE html>
<html lang="en" prefix="og: http://ogp.me/ns#">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="alternate" type="application/rss+xml" title="{{ trans('seo.rss') }}" href="{{ url('blog/rss.xml') }}">
        <link rel="alternate" type="application/rss+xml" title="{{ trans('seo.rss_now') }}" href="{{ url('now/rss.xml') }}">

        @semanticSEO

        @stack('head')

    </head>

    <body class="@yield('body-class')">

        @yield('content')

        @stack('scripts')

        @if (! has_timezone_offset())
            <script>
                (function() {
                    fetch('{{ route('api.timezone.store') }}', {
                        credentials: 'same-origin',
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            offset: (new Date).getTimezoneOffset(),
                        }),
                    });
                })();
            </script>
        @endif

    </body>

</html>
