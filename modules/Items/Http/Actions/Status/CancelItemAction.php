<?php

namespace Modules\Items\Http\Actions\Status;

use Modules\Items\Http\Contracts\Status\CancelItemInterface;
use Modules\Items\Models\Item;
use Modules\Exceptions\ItemNotFoundException;
use Exception;

class CancelItemAction implements CancelItemInterface
{
    // Cancel an item (transition from 'pending' or 'in_progress' to 'canceled')
    public function execute(string $id)
    {
        $item = Item::find($id);
        if(!$item)
        {
            throw new ItemNotFoundException();
        }
        if ($item && $item->canApply('cancel')) 
        {
            $item->apply('cancel');
            $item->save();
            return $item;
        }

        throw new Exception;
    }
}