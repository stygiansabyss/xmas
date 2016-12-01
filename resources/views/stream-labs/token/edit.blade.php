<div class="container-fluid">
    {!! Form::open() !!}
    <div class="lead">Edit {{ $token->channel }}'s Token</div>
    <div class="form-group">
        <label for="api_token" class="control-label col-xs-4 col-md-2">API Token</label>
        <div class="col-xs-8 col-md-10">
            {!! Form::text('api_token', $token->api_token, ['class' => 'form-control']) !!}
            <p class="help-block">You can find your token <a href="https://streamlabs.com/dashboard/api-settings" target="_blank">here</a>.</p>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-4 col-md-offset-2 col-sm-8 col-md-10">
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Submit</button>
            <a href="{{ route('stream-labs.token.index') }}" class="btn btn-default">Cancel</a>
        </div>
    </div>
    {!! Form::close() !!}
</div>