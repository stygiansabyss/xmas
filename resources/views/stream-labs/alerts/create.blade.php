<div class="container-fluid">
    {!! Form::open() !!}
    <div class="lead">Create New Alert</div>
    <div class="form-group">
        <label for="api_token" class="control-label col-xs-4 col-md-2">Name</label>
        <div class="col-xs-8 col-md-10">
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
            <p class="help-block">A friendly name to keep track of the different alert amounts.</p>
        </div>
    </div>
    <div class="form-group">
        <label for="api_token" class="control-label col-xs-4 col-md-2">URL to Sound</label>
        <div class="col-xs-8 col-md-10">
            {!! Form::text('sound_href', null, ['class' => 'form-control']) !!}
            <p class="help-block">Any file type supported by StreamLabs is supported.</p>
        </div>
    </div>
    <div class="form-group">
        <label for="api_token" class="control-label col-xs-4 col-md-2">URL to Image</label>
        <div class="col-xs-8 col-md-10">
            {!! Form::text('image_href', null, ['class' => 'form-control']) !!}
            <p class="help-block">Any file type supported by StreamLabs is supported.</p>
        </div>
    </div>
    <div class="form-group">
        <label for="api_token" class="control-label col-xs-4 col-md-2">Amount</label>
        <div class="col-xs-8 col-md-10">
            {!! Form::text('minimum_amount', null, ['class' => 'form-control']) !!}
            <p class="help-block">Amount required for this alert (Without currency signs, e.g. <code>25.50</code>)</p>
        </div>
    </div>
    <div class="form-group">
        <label for="api_token" class="control-label col-xs-4 col-md-2">Exact amount?</label>
        <div class="col-xs-8 col-md-10">
            {!! Form::checkbox('exact_flag', null) !!}
            <p class="help-block">Does the donation need to match the amount (check) or be greater than or equal to it (uncheck)?</p>
        </div>
    </div>
    <div class="form-group">
        <label for="api_token" class="control-label col-xs-4 col-md-2">Template</label>
        <div class="col-xs-8 col-md-10">
            {!! Form::text('template', null, ['class' => 'form-control']) !!}
            <p class="help-block"><code>{name}</code> for donor name and <code>{amount}</code> for donor amount (includes $ automatically). Use * for special text (e.g. *{name}* )</p>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-4 col-md-offset-2 col-sm-8 col-md-10">
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Submit</button>
            <a href="{{ route('stream-labs.alerts.index') }}" class="btn btn-default">Cancel</a>
        </div>
    </div>
    {!! Form::close() !!}
</div>