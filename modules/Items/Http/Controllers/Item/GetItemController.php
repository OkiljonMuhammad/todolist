<?php

namespace Modules\Items\Http\Controllers\Item;

use Modules\Items\Http\Contracts\Item\GetItemInterface;
use App\Http\Controllers\Controller;

class GetItemController extends Controller
{
    public function __invoke(GetItemInterface $getItem)
    {
        return $getItem->execute();
    }
}