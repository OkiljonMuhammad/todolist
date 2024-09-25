<?php

namespace Modules\Items\Http\Controllers\Status;

use App\Http\Controllers\Controller;
use Modules\Items\Http\Contracts\Status\RestoreItemInterface;
use Illuminate\Support\Facades\Lang;
use Modules\Exceptions\ItemNotFoundException;
use Exception;

class RestoreItemController extends Controller
{
    public function __invoke(RestoreItemInterface $restoreItem, string $id)
    {
        try {
            $restoreItem->execute($id);
            return response()->json(['message' => Lang::get('item.restore')]);

        } catch (ItemNotFoundException)
        {
           return response()->json(['message' => Lang::get('item.item_not_found')]);
        }catch (Exception)
        {
           return response()->json(['message' => Lang::get('item.restore_error')]);
        } 
    }
}