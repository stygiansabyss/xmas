<div class="container-fluid">
  <table class="table table-hover">
    <thead>
      <tr>
        <th>Target</th>
        <th>Count</th>
        <th>Reward</th>
        <th>Reached</th>
        <th>Duration</th>
        <th style="width: 100px;">
          <a href="{{ route('incentive.create') }}" class="btn btn-primary pull-right">
            Add Incentive
          </a>
        </th>
      </tr>
    </thead>
    <tbody>
      @if ($incentives->count() > 0)
        @foreach ($incentives as $incentive)
          <tr>
            <td>{{ $incentive->target }}</td>
            <td>{{ $incentive->count }}</td>
            <td>{{ $incentive->reward }}</td>
            <td>{{ $incentive->reached_at_short }}</td>
            <td>{{ $incentive->duration }}</td>
            <td class="text-right">
              <a href="{{ route('incentive.edit', $incentive->id) }}" class="btn btn-xs btn-info">
                <i class="fa fa-edit"></i>
              </a>
            </td>
          </tr>
        @endforeach
      @else
        <tr>
          <td colspan="3">No incentives have been added yet.</td>
        </tr>
      @endif
    </tbody>
  </table>
  @if ($incentives->total() > 25)
    <div class="panel-footer text-center">
      {!! $incentives->render() !!}
    </div>
  @endif
</div>
