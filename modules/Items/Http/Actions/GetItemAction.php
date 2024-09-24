<?php

namespace Modules\Items\Http\Actions;

use Modules\Items\Http\Contracts\GetItemInterface;
use Modules\Items\Models\Item;

class GetItemAction implements GetItemInterface
{  
    public function execute()
    {
        return Item::orderBy('created_at', 'DESC')->get();
    }

}