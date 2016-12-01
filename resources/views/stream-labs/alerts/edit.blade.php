<div class="container-fluid">
  <div class="lead">Create New Alert</div>
  {!! BootForm::openHorizontal(['xs' => [4, 8], 'md' => [2, 10]]) !!}
    {!! BootForm::text('Name', 'name', $alert->name)
        ->helpBlock('A friendly name to keep track of the different alert amounts.') !!}

    {!! BootForm::text('URL to Sound', 'sound_href', $alert->sound_href)
        ->helpBlock('Any file type supported by StreamLabs is supported.') !!}

    {!! BootForm::text('URL to Image', 'image_href', $alert->image_href)
        ->helpBlock('Any file type supported by StreamLabs is supported.') !!}

    {!! BootForm::text('Amount', 'minimum_amount', $alert->minimum_amount)
        ->helpBlock('Amount required for this alert (Without currency signs, e.g. <code>25.50</code>)') !!}

    {!! BootForm::select('Exact amount?', 'exact_flag', ['No', 'Yes'], $alert->exact_flag)
        ->helpBlock('Does the donation need to match the amount (Yes) or be greater than or equal to it (No)?') !!}

    {!! BootForm::text('Template', 'template', $alert->template)
        ->helpBlock('<code>{name}</code> for donor name and <code>{amount}</code> for donor amount (includes $ automatically). Use * for special text (e.g. *{name}* )') !!}
    <div class="form-group">
      <div class="col-sm-offset-4 col-md-offset-2 col-sm-8 col-md-10">
        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Submit</button>
        <a href="{{ route('stream-labs.alerts.index') }}" class="btn btn-default">Cancel</a>
      </div>
    </div>
  {!! BootForm::close() !!}
</div>
