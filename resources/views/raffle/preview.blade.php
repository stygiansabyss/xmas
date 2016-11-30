<div class="container">
  <a href="{{ route('raffle.approve', [$id]) }}" class="btn btn-success btn-block">Approve Display</a>
  @foreach ($tiers as $tier)
    <h1 class="text-primary">{{ $tier->minimum }} - {{ $tier->reward }}</h1>
    @foreach ($tier->winners as $winner)
      @if ($winner->pivot->status == 1)
        <h2>{{ $winner->name }} - {{ $winner->email }}</h2>
        <h3 class="text-muted">{{ $winner->comment == '' ? 'No comment provided' : $winner->comment }}</h3>
        <br />
      @endif
    @endforeach
    <div class="hr-divider"></div>
  @endforeach
</div>
