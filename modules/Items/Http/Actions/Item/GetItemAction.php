<?php

namespace Modules\Items\Http\Actions\Item;

use Modules\Items\Http\Contracts\Item\GetItemInterface;
use Modules\Items\Models\Item;
use Illuminate\Support\Facades\Auth;


class GetItemAction implements GetItemInterface
{  
    public function execute()
    {
        return Item::where('user_id', Auth::id())
            ->orderBy('created_at', 'DESC')
            ->get();
    }

}