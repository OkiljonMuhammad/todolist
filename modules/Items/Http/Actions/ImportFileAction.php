<?php

namespace Modules\Items\Http\Actions;

use Modules\Items\Http\Contracts\ImportFileInterface;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ItemsImport;

class ImportFileAction implements ImportFileInterface
{
    public function execute($file)
    {
        Excel::import(new ItemsImport, $file->file('file'));
    }
}