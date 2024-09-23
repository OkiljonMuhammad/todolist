<?php

namespace Modules\Items\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Lang;
use Modules\Items\Http\Contracts\ExportFileInterface;
use Exception;

class ExportFileController extends Controller
{   
    // Import from excel file
    public function __invoke(ExportFileInterface $exportFile)
    {
        try {
                return $exportFile->export();
            } 
        catch (Exception $e) {
                return response()->json([
                'error' => Lang::get('item.export_error'),
                'message' => $e->getMessage(),
            ]);
        }
    }
}