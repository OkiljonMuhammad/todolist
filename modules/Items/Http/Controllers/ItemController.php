<?php

namespace Modules\Items\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Items\Models\Item;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Lang;
use Illuminate\Http\JsonResponse;

class ItemController extends Controller
{  
    // Get items
    public function index()
    {
        return Item::orderBy('created_at', 'DESC')->get();
    }

    public function store(Request $request, Item $newItem): Item
    {   
        $request->validate([
            'item.name' => 'required|string|max:255'
        ]);
        $newItem->name = $request->item['name'];
        $newItem->save();

        return $newItem;
    }
    // Update an item
    public function update(Request $request, string $id)
    {
        $existingItem = Item::find($id);
        
        if ($existingItem) {
            $existingItem->name = $request->item['name'] ?? $existingItem->name;
            $existingItem->completed = $request->item['completed'] ?? false;
            $existingItem->completed_at = $request->item['completed'] ?? false ? Carbon::now() : null;
            $existingItem->save();

            return $existingItem;
        }

        return response()->json(['message' => Lang::get('item.item_not_found')]);
    }

    // Delete an item
    public function destroy(string $id): JsonResponse
    {
        $existingItem = Item::find($id);

        if($existingItem)
        {
            $existingItem->delete();

            return response()->json(['message' => Lang::get('item.item_deleted')]);
        }

        return response()->json(['message' => Lang::get('item.item_not_found')]);

    }

    // Start an item (transition from 'new' to 'in_progress')
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

    // Cancel an item (transition from 'new' or 'in_progress' to 'canceled')
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

    // Restore an item (transition from 'archived' or 'canceled' to 'new')
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
