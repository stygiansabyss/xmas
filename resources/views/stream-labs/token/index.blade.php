<div class="container-fluid">
    <table class="table table-responsive table-hover">
        <thead>
        <tr>
            <th>Channel</th>
            <th>Expires at</th>
            <th class="text-center">API Token</th>
            <th class="text-right">
                <a href="{{ route('stream-labs.token.create') }}" class="btn btn-primary">
                    Add Token
                </a>
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach ($tokens as $token)
            <tr>
                <td>
                    <a href="http://twitch.tv/{{ $token->channel }}" target="_blank">
                        {{ $token->channel }}
                    </a>
                </td>
                <td>
                    {{ $token->expires_at->format('F jS, Y \a\t g:ia') }}
                </td>
                <td class="text-center">
                    @if (is_null($token->api_token))
                        <a href="{{ route('stream-labs.token.edit', [$token->id]) }}">
                            <i class="fa fa-fw fa-plus-circle text-primary"></i>
                        </a>
                    @else
                        <i class="fa fa-fw fa-check-circle text-success"></i>
                    @endif
                </td>
                <td class="text-right">
                    <a href="{{ route('stream-labs.token.delete', [$token->id]) }}" class="btn btn-sm btn-link btn-danger text-danger" data-method="delete">
                        <i class="fa fa-fw fa-edit"></i>&nbsp;Delete
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>