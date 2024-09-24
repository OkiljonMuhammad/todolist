<?php

namespace Modules\Items\Http\Controllers\Item;

use Modules\Items\Http\Contracts\Item\DestroyItemInterface;
use Illuminate\Support\Facades\Lang;
use App\Http\Controllers\Controller;
use Modules\Exceptions\ItemNotFoundException;
use Illuminate\Http\JsonResponse;
use Exception;

class DestroyItemController extends Controller
{
    public function __invoke(DestroyItemInterface $destroyItem, string $id): JsonResponse
    {   
        try {
            $destroyItem->execute($id);

            return response()->json(['message' => Lang::get('item.item_deleted')]);

        } catch (ItemNotFoundException)
        {
           return response()->json(['message' => Lang::get('item.item_not_found')]);
        } catch (Exception $e)
        {
           return response()->json(['message' => $e->getMessage()]);
        }
    }
}