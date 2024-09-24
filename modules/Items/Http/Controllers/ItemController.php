<?php

namespace Modules\Items\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Items\Models\Item;
use Illuminate\Support\Facades\Lang;
use Illuminate\Http\JsonResponse;

class ItemController extends Controller
{  
    // Start an item (transition from 'pending' to 'in_progress')
    public function start(string $id)
    {
        $item = Item::find($id);

        if ($item && $item->canApply('start')) {

            $item->apply('start');
            $item->save();

            return response()->json(['message' => Lang::get('item.start')]);
        }

        return response()->json(['message' => Lang::get('item.start_error')]);
    }

    // Complete an item (transition from 'in_progress' to 'completed')
    public function complete(string $id)
    {
        $item = Item::find($id);

        if ($item && $item->canApply('complete')) {

            $item->apply('complete');
            $item->save();

            return response()->json(['message' => Lang::get('item.complete')]);
        }

        return response()->json(['message' => Lang::get('item.complete_error')]);
    }

    // Archive an item (transition from 'completed' to 'archived')
    public function archive(string $id)
    {
        $item = Item::find($id);

        if ($item && $item->canApply('archive')) {

            $item->apply('archive');
            $item->save();

            return response()->json(['message' => Lang::get('item.archive')]);
        }

        return response()->json(['message' => Lang::get('item.archive_error')]);
    }

    // Cancel an item (transition from 'pending' or 'in_progress' to 'canceled')
    public function cancel(string $id)
    {
        $item = Item::find($id);

        if ($item && $item->canApply('cancel')) {

            $item->apply('cancel');
            $item->save();

            return response()->json(['message' => Lang::get('item.cancel')]);
        }

        return response()->json(['message' => Lang::get('item.cancel_error')]);
    }

    // Restore an item (transition from 'archived' or 'canceled' to 'pending')
    public function restore(string $id)
    {
        $item = Item::find($id);

        if ($item && $item->canApply('restore')) {

            $item->apply('restore');
            $item->save();

            return response()->json(['message' => Lang::get('item.restore')]);
        }

        return response()->json(['message' => Lang::get('item.restore_error')]);
    }
}
