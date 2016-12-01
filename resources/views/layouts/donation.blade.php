<!doctype html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $pageTitle or null }} | {{ env('APP_NAME') }}!</title>

    <link rel="shortcut icon" href="{{ URL::to('/favicon.ico') }}" />

    {!! HTML::style('css/dark.css') !!}

    <script src="{{ config('app.node_server') }}:{{ config('app.node_port') }}/socket.io/socket.io.js"></script>
  </head>

  <body class="donation-body">

    <div class=container" id="content">
      @if (isset($content))
        {!! $content !!}
      @else
        @yield('content')
      @endif
    </div>

    @include('layouts.partials.javascript')

  </body>
</html>
