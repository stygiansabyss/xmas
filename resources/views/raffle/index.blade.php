<div class="container-fluid">
  <table class="table table-hover">
    <thead>
      <tr>
        <th>Label</th>
        <th>Tiers</th>
        <th>Winners</th>
        <th style="width: 100px;">
          <a href="{{ route('raffle.create') }}" class="btn btn-primary pull-right">
            Add Raffle
          </a>
        </th>
      </tr>
    </thead>
    <tbody>
      @if ($raffles->count() > 0)
        @foreach ($raffles as $raffle)
          <tr>
            <td>{{ $raffle->name }}</td>
            <td>{{ $raffle->tiers()->count() }}</td>
            <td>{{ $raffle->tiers->winners()->count() }}</td>
            <td class="text-right">
              <div class="btn-group">
                <a href="{{ route('raffle.edit', $raffle->id) }}" class="btn btn-xs btn-info"><i class="fa fa-edit"></i></a>
                <a href="{{ route('raffle.winner', $raffle->id) }}" class="btn btn-xs btn-warning"><i class="fa fa-trophy"></i></a>
              </div>
            </td>
          </tr>
        @endforeach
      @else
        <tr>
          <td colspan="3">No raffles have been added yet.</td>
        </tr>
      @endif
    </tbody>
  </table>
  @if ($raffles->total() > 25)
    <div class="panel-footer text-center">
      {!! $raffles->render() !!}
    </div>
  @endif
</div>
