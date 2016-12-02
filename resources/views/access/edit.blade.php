<div class="container-fluid">
    <div class="lead">Edit Access</div>
    {!! BootForm::openHorizontal(['xs' => [4, 8], 'md' => [2, 10]]) !!}
    {!! BootForm::text('Email', 'email', $access->email)->helpBlock('This should be their twitch email.') !!}
    {!! BootForm::select('Role', 'role_id', $roles)->select($access->role_id) !!}
    <div class="form-group">
        <div class="col-sm-offset-4 col-md-offset-2 col-sm-8 col-md-10">
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Submit</button>
            <a href="{{ route('access.index') }}" class="btn btn-link">Cancel</a>
        </div>
    </div>
    {!! BootForm::close() !!}
</div>
