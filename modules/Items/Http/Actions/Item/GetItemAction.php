<?php

namespace Modules\Items\Http\Actions\Item;

use Modules\Items\Http\Contracts\Item\GetItemInterface;
use Modules\Items\Models\Item;

class GetItemAction implements GetItemInterface
{  
    public function execute()
    {
        return Item::orderBy('created_at', 'DESC')->get();
    }

}