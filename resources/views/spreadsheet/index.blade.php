<div class="container-fluid">
  <div class="row">
    <div class="col-md-offset-4 col-md-4">
      <p class="lead">Donation Spreadsheets</p>
      <table class="table table-striped table-hover">
        <tbody>
          @if (count($spreadsheets) > 0)
            @foreach ($spreadsheets as $spreadsheet)
              <tr>
                <td>{!! str_replace(public_path('spreadsheets'), '', $spreadsheet) !!}</td>
                <td class="text-right">
                  <a href="/spreadsheets/{{ str_replace(public_path('spreadsheets/'), '', $spreadsheet) }}"
                     class="btn btn-xs btn-primary"
                  >
                    <i class="fa fa-download"></i>
                  </a>
                </td>
              </tr>
            @endforeach
          @else
            <tr>
              <td colspan="2">No spreadsheets saved yet.</td>
            </tr>
          @endif
        </tbody>
      </table>
    </div>
  </div>
</div>
