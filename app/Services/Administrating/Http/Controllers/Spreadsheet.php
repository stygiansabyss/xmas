<?php

namespace App\Services\Administrating\Http\Controllers;

use App\Http\Controllers\BaseController;
use Illuminate\Filesystem\Filesystem;

class Spreadsheet extends BaseController
{
    /**
     * @var \Illuminate\Filesystem\Filesystem
     */
    private $files;

    /**
     * Spreadsheet constructor.
     *
     * @param \Illuminate\Filesystem\Filesystem $files
     */
    public function __construct(Filesystem $files)
    {
        $this->files = $files;
    }

    public function __invoke()
    {
        $spreadsheets = $this->files->files(public_path('spreadsheets'));

        $this->setViewData(compact('spreadsheets'));

        return $this->view('spreadsheet.index');
    }
}
