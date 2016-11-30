<div class="container-fluid">
  <div class="lead">Create New Incentive</div>
  {!! BootForm::openHorizontal(['xs' => [4, 8], 'md' => [2, 10]]) !!}
    {!! BootForm::text('Target', 'target') !!}
    {!! BootForm::text('Reward', 'reward') !!}
    <div class="form-group">
      <div class="col-sm-offset-4 col-md-offset-2 col-sm-8 col-md-10">
        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Submit</button>
        <a href="{{ route('administrating.dashboard') }}" class="btn btn-link">Cancel</a>
      </div>
    </div>
  {!! BootForm::close() !!}
</div>
