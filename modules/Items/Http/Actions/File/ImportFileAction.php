<?php

namespace Modules\Items\Http\Actions\File;

use Modules\Items\Http\Contracts\File\ImportFileInterface;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ItemsImport;

class ImportFileAction implements ImportFileInterface
{
    public function execute($file)
    {
        Excel::import(new ItemsImport, $file);
    }
}