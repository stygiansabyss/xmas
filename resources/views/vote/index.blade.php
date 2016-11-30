<div class="container-fluid">
  <table class="table table-hover">
    <thead>
      <tr>
        <th>Label</th>
        <th>Options</th>
        <th style="width: 100px;">
          <a href="{{ route('vote.create') }}" class="btn btn-primary pull-right">
            Add Vote
          </a>
        </th>
      </tr>
    </thead>
    <tbody>
      @if ($votes->count() > 0)
        @foreach ($votes as $vote)
          <tr>
            <td>{{ $vote->name }}</td>
            <td>{{ humanReadableImplode($vote->options->key_word->toArray()) }}</td>
            <td class="text-right">
              <div class="btn-group">
                <a href="{{ route('vote.edit', $vote->id) }}" class="btn btn-xs btn-info"><i class="fa fa-edit"></i></a>
              </div>
            </td>
          </tr>
        @endforeach
      @else
        <tr>
          <td colspan="3">No votes have been added yet.</td>
        </tr>
      @endif
    </tbody>
  </table>
  @if ($votes->total() > 25)
    <div class="panel-footer text-center">
      {!! $votes->render() !!}
    </div>
  @endif
</div>
