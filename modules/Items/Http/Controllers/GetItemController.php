<?php

namespace Modules\Items\Http\Controllers;

use Modules\Items\Http\Contracts\GetItemInterface;
use App\Http\Controllers\Controller;

class GetItemController extends Controller
{
    public function __invoke(GetItemInterface $getItem)
    {
        return $getItem->execute();
    }
}