<div class="container-fluid">
  <table class="table table-striped table-hover">
    <thead>
      <tr>
        <th>Preview</th>
        <th>Name</th>
        <th>Width</th>
        <th>Height</th>
        <th>&nbsp;</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($images->chunk(2) as $imageGroup)
        <tr>
          @foreach($imageGroup as $image)
            <td class="gray-dark text-center" style="width: 150px; height: 100px; vertical-align: middle;">
              <a href="{{ $image->path }}" target="_blank">
                <img src="{{ $image->path }}" alt="" style="max-width: 100px; max-height: 100px;" />
              </a>
            </td>
            <td>{{ $image->name }}</td>
            <td>{{ $image->width }}px</td>
            <td>{{ $image->height }}px</td>
            <td class="text-right">
              <a href="{{ route('administrating.asset.edit', $image->id) }}" class="btn btn-sm btn-link btn-info">
                <i class="fa fa-fw fa-edit"></i>&nbsp;Edit
              </a>
              <a href="" class="btn btn-sm btn-link btn-danger text-danger" data-method="delete">
                <i class="fa fa-fw fa-edit"></i>&nbsp;Delete
              </a>
            </td>
          @endforeach
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
