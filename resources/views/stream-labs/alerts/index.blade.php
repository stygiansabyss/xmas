<div class="container-fluid">
    <table class="table table-responsive table-hover">
        <thead>
        <tr>
            <th>Name</th>
            <th class="text-center">Sound URL</th>
            <th class="text-center">Image URL</th>
            <th class="text-center">Donation Amount (USD)</th>
            <th class="text-center">Type</th>
            <th class="text-center">Template</th>
            <th class="text-right">
                <a href="{{ route('stream-labs.alerts.create') }}" class="btn btn-primary">
                    Add Amount
                </a>
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach ($alerts as $alert)
            <tr>
                <td>
                    {{ $alert->name }}
                </td>
                <td class="text-center">
                    {{ $alert->sound_href }}
                </td>
                <td class="text-center">
                    {{ $alert->image_href }}
                </td>
                <td class="text-center">
                    {{ $alert->minimum_amount }}
                </td>
                <td class="text-center">
                    {{ $alert->exact ? 'Exact' : 'Minimum' }}
                </td>
                <td class="text-center">
                    {{ $alert->template }}
                </td>
                <td class="text-right">
                    <div class="btn-group">
                        <a href="{{ route('stream-labs.alerts.edit', [$alert->id]) }}" class="btn btn-sm btn-link btn-success text-primary">
                            <i class="fa fa-fw fa-edit"></i>&nbsp;Edit
                        </a>
                        <a href="{{ route('stream-labs.alerts.delete', [$alert->id]) }}" class="btn btn-sm btn-link btn-danger text-danger" data-method="delete">
                            <i class="fa fa-fw fa-edit"></i>&nbsp;Delete
                        </a>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>