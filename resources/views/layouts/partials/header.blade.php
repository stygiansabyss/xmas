<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>{{ $pageTitle or null }} | {{ env('APP_NAME') }}!</title>

<link rel="shortcut icon" href="{{ URL::to('/favicon.ico') }}" />

<!-- Local styles -->
{!! HTML::style('css/app.css') !!}

<script src="{{ env('NODE_SERVER') }}:{{ env('NODE_PORT') }}/socket.io/socket.io.js"></script>

<!-- Css -->
@section('css')
@show
<!-- Css Form -->
@section('cssForm')
@show
