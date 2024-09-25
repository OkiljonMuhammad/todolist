<?php

namespace Modules\Items\Http\Controllers\Status;

use App\Http\Controllers\Controller;
use Modules\Items\Http\Contracts\Status\CancelItemInterface;
use Illuminate\Support\Facades\Lang;
use Modules\Exceptions\ItemNotFoundException;
use Exception;

class CancelItemController extends Controller
{
    public function __invoke(CancelItemInterface $cancelItem, string $id)
    {
        try {
            $cancelItem->execute($id);
            return response()->json(['message' => Lang::get('item.cancel')]);

        } catch (ItemNotFoundException)
        {
           return response()->json(['message' => Lang::get('item.item_not_found')]);
        }catch (Exception)
        {
           return response()->json(['message' => Lang::get('item.cancel_error')]);
        } 
    }
}