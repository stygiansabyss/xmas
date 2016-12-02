<div class="container-fluid">
  <div class="alert alert-info">
    All users using emails for <code>@yogscast.com</code> and <code>@hat-films.com</code> will get assigned to streamer if not on this list.  All other users will be assigned as guest and not allowed to access any areas.
  </div>
  <table class="table table-hover">
    <thead>
      <tr>
        <th>Email</th>
        <th>Role</th>
        <th style="width: 100px;">
          <a href="{{ route('access.create') }}" class="btn btn-primary pull-right">
            Add Access
          </a>
        </th>
      </tr>
    </thead>
    <tbody>
      @if ($accesses->count() > 0)
        @foreach ($accesses as $access)
          <tr>
            <td>{{ $access->email }}</td>
            <td>{{ $access->role->name }}</td>
            <td class="text-right">
              <div class="btn-group">
                <a href="{{ route('access.edit', $access->id) }}" class="btn btn-xs btn-info">
                  <i class="fa fa-edit"></i>
                </a>
                <a href="{{ route('access.delete', $access->id) }}" class="btn btn-xs btn-danger confirm-remove">
                  <i class="fa fa-trash"></i>
                </a>
              </div>
            </td>
          </tr>
        @endforeach
      @else
        <tr>
          <td colspan="3">No access levels have been added yet.</td>
        </tr>
      @endif
    </tbody>
  </table>
</div>
