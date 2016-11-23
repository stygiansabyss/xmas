<div class="container-fluid">
    {!! Form::open() !!}
    <div class="lead">Edit Alert: {{ $alert->name }}</div>
    <div class="form-group">
        <label for="api_token" class="control-label col-xs-4 col-md-2">Name</label>
        <div class="col-xs-8 col-md-10">
            {!! Form::text('name', $alert->name, ['class' => 'form-control']) !!}
            <p class="help-block">A friendly name to keep track of the different alert amounts.</p>
        </div>
    </div>
    <div class="form-group">
        <label for="api_token" class="control-label col-xs-4 col-md-2">URL to Sound</label>
        <div class="col-xs-8 col-md-10">
            {!! Form::text('sound_href', $alert->sound_href, ['class' => 'form-control']) !!}
            <p class="help-block">Any file type supported by StreamLabs is supported.</p>
        </div>
    </div>
    <div class="form-group">
        <label for="api_token" class="control-label col-xs-4 col-md-2">URL to Image</label>
        <div class="col-xs-8 col-md-10">
            {!! Form::text('image_href', $alert->image_href, ['class' => 'form-control']) !!}
            <p class="help-block">Any file type supported by StreamLabs is supported.</p>
        </div>
    </div>
    <div class="form-group">
        <label for="api_token" class="control-label col-xs-4 col-md-2">Minimum Amount</label>
        <div class="col-xs-8 col-md-10">
            {!! Form::text('minimum_amount', $alert->minimum_amount, ['class' => 'form-control']) !!}
            <p class="help-block">Minimum amount required to reach this alert (Without currency signs, e.g. <code>25.50</code>)</p>
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