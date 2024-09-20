<?php

namespace Modules\Items\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Lang;
use Modules\Items\Http\Actions\ImportFileAction;
use Exception;

class ImportFileController extends Controller
{   
    // Import from excel file
    public function __invoke(ImportFileAction $importFile)
    {
        try {

            $importFile->import(request());
            return response()->json(['message' => Lang::get('item.import')]);

            } 
        catch (Exception $e) {

            return response()->json([
                'error' => Lang::get('item.import_error'),
                'message' => $e->getMessage(),

            ]);
        }
    }
}