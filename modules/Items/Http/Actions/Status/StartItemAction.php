<?php

namespace Modules\Items\Http\Actions\Status;

use Modules\Items\Http\Contracts\Status\StartItemInterface;
use Modules\Items\Models\Item;
use Modules\Exceptions\ItemNotFoundException;
use Exception;

class StartItemAction implements StartItemInterface
{
     // Start an item (transition from 'pending' to 'in_progress')
    public function execute(string $id)
    {
        $item = Item::find($id);
        if(!$item)
        {
            throw new ItemNotFoundException();
        }
        if ($item && $item->canApply('start')) 
        {
            $item->apply('start');
            $item->save();
            return $item;
        }

        throw new Exception;
    }
}