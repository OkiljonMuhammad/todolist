<?php

namespace Modules\Items\Http\Actions\Status;

use Modules\Items\Http\Contracts\Status\ArchiveItemInterface;
use Modules\Items\Models\Item;
use Modules\Exceptions\ItemNotFoundException;
use Exception;

class ArchiveItemAction implements ArchiveItemInterface
{
    // Archive an item (transition from 'completed' to 'archived')
    public function execute(string $id)
    {
        $item = Item::find($id);
        if(!$item)
        {
            throw new ItemNotFoundException();
        }
        if ($item && $item->canApply('archive')) 
        {
            $item->apply('archive');
            $item->save();
            return $item;
        }

        throw new Exception;
    }
}