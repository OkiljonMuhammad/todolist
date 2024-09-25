<?php

namespace Modules\Items\Http\Actions\Status;

use Modules\Items\Http\Contracts\Status\CompleteItemInterface;
use Modules\Items\Models\Item;
use Modules\Exceptions\ItemNotFoundException;
use Exception;

class CompleteItemAction implements CompleteItemInterface
{
    // Complete an item (transition from 'in_progress' to 'completed')
    public function execute(string $id)
    {
        $item = Item::find($id);
        if(!$item)
        {
            throw new ItemNotFoundException();
        }
        if ($item && $item->canApply('complete')) 
        {
            $item->apply('complete');
            $item->save();
            return $item;
        }

        throw new Exception;
    }
}