<div class="container-fluid">
  <table class="table table-hover">
    <thead>
      <tr>
        <th>Starting</th>
        <th>Goal</th>
        <th>Difference</th>
        <th>% Complete</th>
        <th>Reached On</th>
        <th>Duration</th>
        <th style="width: 100px;">
          <a href="{{ route('goal.create') }}" class="btn btn-primary pull-right">
            Add Goal
          </a>
        </th>
      </tr>
    </thead>
    <tbody>
      @if ($goals->count() > 0)
        @foreach ($goals as $goal)
          <tr>
            <td>{{ $goal->start_value }}</td>
            <td>{{ $goal->goal }}</td>
            <td>{{ $goal->difference }}</td>
            <td>{{ $goal->percent }}</td>
            <td>{{ $goal->reached_at_short }}</td>
            <td>{{ $goal->duration }}</td>
            <td class="text-right">
              <div class="btn-group">
                <a href="{{ route('goal.edit', $goal->id) }}" class="btn btn-xs btn-info">
                  <i class="fa fa-edit"></i>
                </a>
              </div>
            </td>
          </tr>
        @endforeach
      @else
        <tr>
          <td colspan="3">No goals have been added yet.</td>
        </tr>
      @endif
    </tbody>
  </table>
  @if ($goals->total() > 25)
    <div class="panel-footer text-center">
      {!! $goals->render() !!}
    </div>
  @endif
</div>
