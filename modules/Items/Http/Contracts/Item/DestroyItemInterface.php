<?php

namespace Modules\Items\Http\Contracts\Item;

interface DestroyItemInterface
{
    public function execute($id);
}