<?php

namespace Modules\Items\Http\Controllers\Item;

use Modules\Items\Http\Contracts\Item\StoreItemInterface;
use Modules\Items\Http\Requests\Item\ItemValidateRequest;
use App\Http\Controllers\Controller;

class StoreItemController extends Controller
{
    public function __invoke(ItemValidateRequest $request, StoreItemInterface $storeItem)
    {   
        return $storeItem->execute($request->item['name']);
    }
}