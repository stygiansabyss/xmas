<div class="container-fluid">
    {!! Form::open() !!}
    <div class="lead">Edit Goal</div>
    <div class="form-group">
        <label for="api_token" class="control-label col-xs-4 col-md-2">Starting Value</label>
        <div class="col-xs-8 col-md-10">
            {!! Form::text('start_value', $goal->start_value, ['class' => 'form-control']) !!}
            <p class="help-block">Current total: {{ $total->raised }}</p>
        </div>
    </div>
    <div class="form-group">
        <label for="api_token" class="control-label col-xs-4 col-md-2">Reached At Date</label>
        <div class="col-xs-8 col-md-10">
            {!! Form::text('reached_at', $goal->reached_at, ['class' => 'form-control']) !!}
            <p class="help-block">YYYY-MM-DD HH:MM:SS</p>
        </div>
    </div>
    <div class="form-group">
        <label for="api_token" class="control-label col-xs-4 col-md-2">Goal</label>
        <div class="col-xs-8 col-md-10">
            {!! Form::text('goal', $goal->goal, ['class' => 'form-control']) !!}
            <p class="help-block"></p>
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