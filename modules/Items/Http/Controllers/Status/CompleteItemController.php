<?php

namespace Modules\Items\Http\Controllers\Status;

use App\Http\Controllers\Controller;
use Modules\Items\Http\Contracts\Status\CompleteItemInterface;
use Illuminate\Support\Facades\Lang;
use Modules\Exceptions\ItemNotFoundException;
use Exception;

class CompleteItemController extends Controller
{
    public function __invoke(CompleteItemInterface $completeItem, string $id)
    {
        try {
            $completeItem->execute($id);
            return response()->json(['message' => Lang::get('item.complete')]);

        } catch (ItemNotFoundException)
        {
           return response()->json(['message' => Lang::get('item.item_not_found')]);
        }catch (Exception)
        {
           return response()->json(['message' => Lang::get('item.complete_error')]);
        } 
    }
}