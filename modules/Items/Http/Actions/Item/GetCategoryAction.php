<?php

namespace Modules\Items\Http\Actions\Item;

use Modules\Items\Http\Contracts\Item\GetCategoryInterface;
use Modules\Items\Models\Item;
use Illuminate\Support\Facades\Auth;


class GetCategoryAction implements GetCategoryInterface
{  
    public function execute()
    {
        return Item::where('user_id', Auth::id())
            ->where('parent_id', null)
            ->orderBy('created_at', 'DESC')
            ->get();
    }

}