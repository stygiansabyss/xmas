<div class="container-fluid">
  <div class="row">
    <div class="col-md-offset-4 col-md-4 gray p-a-1">
      <img src="{{ $image->path }}" alt="" class="img-responsive m-x-auto" />
    </div>
  </div>
  <div class="row">
    <div class="col-md-offset-4 col-md-4">
      <table class="table">
        <tbody>
          <tr>
            <td><strong>File</strong></td>
            <td>{{ $image->name }}</td>
          </tr>
          <tr>
            <td><strong>Path</strong></td>
            <td>{{ $image->path }}</td>
          </tr>
          <tr>
            <td><strong>Width</strong></td>
            <td>{{ $image->width }}px</td>
          </tr>
          <tr>
            <td><strong>Height</strong></td>
            <td>{{ $image->height }}px</td>
          </tr>
        </tbody>
      </table>
      {!! BootForm::open()->multipart() !!}
      <div class="m-x-auto" style="width: {{ $image->width }}px; max-width: 650px;">
        <div class="fileinput fileinput-new" data-provides="fileinput">
          <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: {{ $image->width }}px; max-width: 650px;height: {{ $image->height }}px; max-height: 400px;">
            <img src="{{ $image->path }}" alt="">
          </div>
          <div>
          <span class="btn btn-default btn-file btn-block">
            <span class="fileinput-new">Select image</span>
            <span class="fileinput-exists">Change</span>
            <input type="file" name="image" />
          </span>
            <a href="#" class="btn btn-default fileinput-exists btn-block" data-dismiss="fileinput">Remove</a>
          </div>
        </div>
        {!! BootForm::submit('Save New Image')->class('btn btn-primary btn-block m-t-2') !!}
      </div>
      {!! BootForm::close() !!}
    </div>
  </div>
</div>
