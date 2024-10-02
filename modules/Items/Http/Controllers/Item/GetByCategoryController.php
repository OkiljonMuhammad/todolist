<?php

namespace Modules\Items\Http\Controllers\Item;

use Modules\Items\Http\Contracts\Item\GetByCategoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class GetByCategoryController extends Controller
{
    public function __invoke(GetByCategoryInterface $getByCategory)
    {
        return $getByCategory->execute();
    }
}