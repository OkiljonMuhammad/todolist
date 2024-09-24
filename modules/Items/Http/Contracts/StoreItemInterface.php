<?php

namespace Modules\Items\Http\Contracts;

use Modules\Items\Models\Item;

interface StoreItemInterface
{
    public function execute($itemName);
}
