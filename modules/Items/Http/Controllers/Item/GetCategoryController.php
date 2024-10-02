<?php

namespace Modules\Items\Http\Controllers\Item;

use Modules\Items\Http\Contracts\Item\GetCategoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class GetCategoryController extends Controller
{
    public function __invoke(GetCategoryInterface $getCategory)
    {
        return $getCategory->execute();
    }
}