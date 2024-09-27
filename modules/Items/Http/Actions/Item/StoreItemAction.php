<?php

namespace Modules\Items\Http\Actions\Item;

use Illuminate\Support\Facades\Auth;
use Modules\Items\Http\Contracts\Item\StoreItemInterface;
use Modules\Items\Models\Item;

class StoreItemAction implements StoreItemInterface
{  
    public function execute($itemName)
    {   
        $newItem = Item::create([
            'name' => $itemName,
            'user_id' => Auth::id(),
        ]);
        
        return $newItem;
    }

}