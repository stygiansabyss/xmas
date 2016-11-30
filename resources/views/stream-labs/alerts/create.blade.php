<div class="container-fluid">
    {!! Form::open() !!}
    <div class="lead">Create New Alert</div>
    {!! BootForm::openHorizontal(['xs' => [4, 8], 'md' => [2, 10]]) !!}
        {!! BootForm::text('Name', 'name', null)
            ->helpBlock('A friendly name to keep track of the different alert amounts.') !!}

        {!! BootForm::text('URL to Sound', 'sound_href', null)
            ->helpBlock('Any file type supported by StreamLabs is supported.') !!}

        {!! BootForm::text('URL to Image', 'image_href', null)
            ->helpBlock('Any file type supported by StreamLabs is supported.') !!}

        {!! BootForm::text('Amount', 'minimum_amount', null)
            ->helpBlock('Amount required for this alert (Without currency signs, e.g. <code>25.50</code>)') !!}

        {!! BootForm::select('Exact amount?', 'exact_flag', ['No', 'Yes'], 0)
            ->helpBlock('Does the donation need to match the amount (Yes) or be greater than or equal to it (No)?') !!}

        {!! BootForm::text('Template', 'template', null)
            ->helpBlock('<code>{name}</code> for donor name and <code>{amount}</code> for donor amount (includes $ automatically). Use * for special text (e.g. *{name}* )') !!}
    <div class="form-group">
        <div class="col-sm-offset-4 col-md-offset-2 col-sm-8 col-md-10">
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Submit</button>
            <a href="{{ route('stream-labs.alerts.index') }}" class="btn btn-default">Cancel</a>
        </div>
    </div>
    {!! BootForm::close() !!}
</div>
