<?php

namespace Modules\Items\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Items\Models\Item;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Lang;
use Illuminate\Http\JsonResponse;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ItemsImport;
use App\Exports\ItemsExport;

class ItemController extends Controller
{   
    // Import from excel file
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:2048',
        ]);

        Excel::import(new ItemsImport, $request->file('file'));

        return response()->json(['message' => 'Items imported successfully']);
    }

    // Export as an excel file
    public function export()
    {
        return Excel::download(new ItemsExport, 'todos.xlsx');
    }

    // Get items
    public function index()
    {
        return Item::orderBy('created_at', 'DESC')->get();
    }

    public function store(Request $request): Item
    {   
        $request->validate([
            'item.name' => 'required|string|max:255'
        ]);
        $newItem = new Item;
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
            $existingItem->completed = $request->item['completed'] ? true : false;
            $existingItem->completed_at = $request->item['completed'] ? Carbon::now() : null;
            $existingItem->save();

            return $existingItem;
        }

        return response()->json(['message' => Lang::get('item.item_not_found')], 404);
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
            return response()->json(['message' => 'Item started successfully']);
        }

        return response()->json(['message' => 'Cannot start this item']);
    }

    // Complete an item (transition from 'in_progress' to 'completed')
    public function complete(string $id)
    {
        $item = Item::find($id);

        if ($item && $item->canApply('complete')) {
            $item->apply('complete');
            $item->save();
            return response()->json(['message' => 'Item completed successfully']);
        }

        return response()->json(['message' => 'Cannot complete this item']);
    }

    // Archive an item (transition from 'completed' to 'archived')
    public function archive(string $id)
    {
        $item = Item::find($id);

        if ($item && $item->canApply('archive')) {
            $item->apply('archive');
            $item->save();
            return response()->json(['message' => 'Item archived successfully']);
        }

        return response()->json(['message' => 'Cannot archive this item']);
    }

    // Cancel an item (transition from 'new' or 'in_progress' to 'canceled')
    public function cancel(string $id)
    {
        $item = Item::find($id);

        if ($item && $item->canApply('cancel')) {
            $item->apply('cancel');
            $item->save();
            return response()->json(['message' => 'Item canceled successfully']);
        }

        return response()->json(['message' => 'Cannot cancel this item']);
    }

    // Restore an item (transition from 'archived' or 'canceled' to 'new')
    public function restore(string $id)
    {
        $item = Item::find($id);

        if ($item && $item->canApply('restore')) {
            $item->apply('restore');
            $item->save();
            return response()->json(['message' => 'Item restored successfully']);
        }

        return response()->json(['message' => 'Cannot restore this item']);
    }

}
