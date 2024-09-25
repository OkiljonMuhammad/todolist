<?php

namespace Modules\Items\Http\Controllers\Status;

use App\Http\Controllers\Controller;
use Modules\Items\Http\Contracts\Status\ArchiveItemInterface;
use Illuminate\Support\Facades\Lang;
use Modules\Exceptions\ItemNotFoundException;
use Exception;

class ArchiveItemController extends Controller
{
    public function __invoke(ArchiveItemInterface $archiveItem, string $id)
    {
        try {
            $archiveItem->execute($id);
            return response()->json(['message' => Lang::get('item.archive')]);

        } catch (ItemNotFoundException)
        {
           return response()->json(['message' => Lang::get('item.item_not_found')]);
        }catch (Exception)
        {
           return response()->json(['message' => Lang::get('item.archive_error')]);
        } 
    }
}