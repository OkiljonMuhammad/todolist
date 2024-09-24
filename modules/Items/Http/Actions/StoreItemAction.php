<?php

namespace Modules\Items\Http\Actions;

use Modules\Items\Http\Contracts\StoreItemInterface;
use Modules\Items\Models\Item;

class StoreItemAction implements StoreItemInterface
{  
    public function execute($itemName)
    {   
        $newItem = new Item;
        $newItem->name = $itemName;
        $newItem->save();
        return $newItem;
    }

}