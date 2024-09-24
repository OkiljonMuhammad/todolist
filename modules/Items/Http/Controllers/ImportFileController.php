<?php

namespace Modules\Items\Http\Controllers;

use Modules\Items\Http\Requests\ImportFileRequest;
use Modules\Items\Http\Contracts\ImportFileInterface;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Lang;
use Exception;

class ImportFileController extends Controller
{   
    // Import from excel file
    public function __invoke(ImportFileRequest $request, ImportFileInterface $importFile)
    {   
        try {
                $importFile->execute($request);
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