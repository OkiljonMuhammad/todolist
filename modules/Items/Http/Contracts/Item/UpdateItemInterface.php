<?php

namespace Modules\Items\Http\Contracts\Item;

interface UpdateItemInterface
{
    public function execute($item, $id);
}