<?php

namespace Modules\Items\Http\Contracts\Item;

use Modules\Items\Models\Item;

interface StoreItemInterface
{
    public function execute($item);
}
