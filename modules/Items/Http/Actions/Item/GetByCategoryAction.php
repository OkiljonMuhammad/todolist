<?php

namespace Modules\Items\Http\Actions\Item;

use Modules\Items\Http\Contracts\Item\GetByCategoryInterface;
use Modules\Items\Models\Item;
use Illuminate\Support\Facades\Auth;


class GetByCategoryAction implements GetByCategoryInterface
{  
    public function execute()
    {
        return Item::where('user_id', Auth::id())->get()->toTree();
    }

}