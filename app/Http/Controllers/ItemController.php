<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Support\Carbon;


class ItemController extends Controller
{   
    //get items
    public function index()
    {
        return Item::orderBy('created_at', 'DESC')->get();
    }

    public function store(Request $request): Item
    {
        $newItem = new Item;
        $newItem->name = $request->item['name'];
        $newItem->save();

        return $newItem;
    }
    // update an item
    public function update(Request $request, string $id): int
    {
        $existingItem = Item::find($id);
        
        if($existingItem)
        {
            $existingItem->completed = $request->item['completed'] ? true : false;
            $existingItem->completed_at = $request->item['completed'] ? Carbon::now() : null;
            $existingItem->save();

            return $existingItem;
        }

        return "Item not found";
    }

    // delete an item
    public function destroy(string $id): string
    {
        $existingItem = Item::find($id);

        if($existingItem)
        {
            $existingItem->delete();

            return "Item successfully deleted";
        }

        return "Item not found";

    }
}
