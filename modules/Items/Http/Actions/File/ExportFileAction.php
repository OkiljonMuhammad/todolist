<?php

namespace Modules\Items\Http\Actions\File;

use Modules\Items\Http\Contracts\File\ExportFileInterface;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ItemsExport;


class ExportFileAction implements ExportFileInterface
{
    public function execute()
    {
        return Excel::download(new ItemsExport, 'todos.xlsx');
    }
}