<?php

namespace Modules\Items\Http\Actions\Status;

use Modules\Items\Http\Contracts\Status\RestoreItemInterface;
use Modules\Items\Models\Item;
use Modules\Exceptions\ItemNotFoundException;
use Exception;

class RestoreItemAction implements RestoreItemInterface
{
    // Restore an item (transition from 'archived' or 'canceled' to 'pending')
    public function execute(string $id)
    {
        $item = Item::find($id);
        if(!$item)
        {
            throw new ItemNotFoundException();
        }
        if ($item && $item->canApply('restore')) 
        {
            $item->apply('restore');
            $item->save();
            return $item;
        }

        throw new Exception;
    }
}