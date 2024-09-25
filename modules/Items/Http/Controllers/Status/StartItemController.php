<?php

namespace Modules\Items\Http\Controllers\Status;

use App\Http\Controllers\Controller;
use Modules\Items\Http\Contracts\Status\StartItemInterface;
use Illuminate\Support\Facades\Lang;
use Modules\Exceptions\ItemNotFoundException;
use Exception;

class StartItemController extends Controller
{
    public function __invoke(StartItemInterface $startItem, string $id)
    {
        try {
            $startItem->execute($id);
            return response()->json(['message' => Lang::get('item.start')]);

        } catch (ItemNotFoundException)
        {
           return response()->json(['message' => Lang::get('item.item_not_found')]);
        }catch (Exception)
        {
           return response()->json(['message' => Lang::get('item.start_error')]);
        } 
    }
}