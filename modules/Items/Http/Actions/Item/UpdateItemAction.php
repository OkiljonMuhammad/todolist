<?php

namespace Modules\Items\Http\Actions\Item;

use Modules\Items\Http\Contracts\Item\UpdateItemInterface;
use Modules\Items\Models\Item;

class UpdateItemAction implements UpdateItemInterface
{  
    public function execute($item, $id)
    {   
        $existingItem = Item::find($id);
        
        if ($existingItem) {
            $existingItem->name = $item['name'];
            $existingItem->save();
            
            return $existingItem;
        }
    }

}