<?php

namespace Modules\Items\Http\Actions;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ItemsExport;


class ExportFileAction
{
    public function export()
    {
        return Excel::download(new ItemsExport, 'todos.xlsx');
    }
}