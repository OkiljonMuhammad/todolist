<?php

namespace Modules\Items\Http\Actions\Item;

use Illuminate\Support\Facades\Auth;
use Modules\Items\Http\Contracts\Item\StoreItemInterface;
use Modules\Items\Models\Item;

class StoreItemAction implements StoreItemInterface
{  
    public function execute($item)
    {   
        if($item['parent_id'] !== null)
        {
            $parent = Item::find($item['parent_id']);
            $parent->children()->create(['name' => $item['name'], 'user_id' => Auth::id()]);
        } 
        else 
        {
            Item::create(['name' => $item['name'], 'user_id' => Auth::id()]);
        }
    }
}