<!doctype html>
<html>
  <head>
    @include('layouts.partials.header')
  </head>

  <body class="overlay-body">

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
