<?php

namespace Modules\Items\Http\Controllers;

use Modules\Items\Http\Contracts\StoreItemInterface;
use Modules\Items\Http\Requests\StoreItemRequest;
use App\Http\Controllers\Controller;

class StoreItemController extends Controller
{
    public function __invoke(StoreItemRequest $request, StoreItemInterface $storeItem)
    {   
        return $storeItem->execute($request->item['name']);
    }
}