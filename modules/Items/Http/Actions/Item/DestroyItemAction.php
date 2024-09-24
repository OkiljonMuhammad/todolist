<?php

namespace Modules\Items\Http\Actions\Item;

use Modules\Items\Http\Contracts\Item\DestroyItemInterface;
use Modules\Items\Models\Item;

class DestroyItemAction implements DestroyItemInterface
{  
    public function execute($id)
    {   
        $existingItem = Item::find($id);
        
        if($existingItem)
        {
            $existingItem->delete();

        }
    }

}