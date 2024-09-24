<?php

namespace Modules\Items\Http\Controllers\Item;

use Modules\Items\Http\Contracts\Item\UpdateItemInterface;
use Modules\Items\Http\Requests\Item\ItemValidateRequest;
use Illuminate\Support\Facades\Lang;
use App\Http\Controllers\Controller;
use Modules\Exceptions\ItemNotFoundException;
use Exception;

class UpdateItemController extends Controller
{
    public function __invoke(ItemValidateRequest $request, UpdateItemInterface $updateItem, string $id)
    {   
        try {
            return $updateItem->execute($request->item, $id);

        } catch (ItemNotFoundException)
        {
            return response()->json(['message' => Lang::get('item.item_not_found')]);
        } catch (Exception $e)
        {
           return response()->json(['message' => $e->getMessage()]);
        }
    }
}