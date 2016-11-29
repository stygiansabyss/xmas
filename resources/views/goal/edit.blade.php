<div class="container-fluid">
    <div class="lead">Edit Goal</div>
    {!! BootForm::openHorizontal(['xs' => [4, 8], 'md' => [2, 10]]) !!}
    {!! BootForm::text('Starting Value', 'start_value', $goal->start_value)->helpBlock('Current total: '. $total->raised) !!}
    {!! BootForm::text('Reached At Date', 'reached_at', $goal->reached_at)->helpBlock('Format: YYYY-MM-DD HH:MM:SS') !!}
    {!! BootForm::text('Goal', 'goal', $goal->goal) !!}
    <div class="form-group">
        <div class="col-sm-offset-4 col-md-offset-2 col-sm-8 col-md-10">
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Submit</button>
            <a href="{{ route('administrating.dashboard') }}" class="btn btn-link">Cancel</a>
        </div>
    </div>
    {!! BootForm::close() !!}
</div>
