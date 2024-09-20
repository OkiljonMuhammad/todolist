<?php

namespace Modules\Items\Http\Actions;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ItemsImport;

class ImportFileAction
{
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:2048',
        ]);

        Excel::import(new ItemsImport, $request->file('file'));
    }
}