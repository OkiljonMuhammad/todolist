<?php

namespace Modules\Items\Http\Actions;

use Modules\Items\Http\Contracts\ExportFileInterface;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ItemsExport;


class ExportFileAction implements ExportFileInterface
{
    public function execute()
    {
        return Excel::download(new ItemsExport, 'todos.xlsx');
    }
}