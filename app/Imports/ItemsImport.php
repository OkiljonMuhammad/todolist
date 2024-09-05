<?php

namespace App\Imports;

use App\Models\Item;
use Maatwebsite\Excel\Concerns\ToModel;

class ItemsImport implements ToModel
{
    public function model(array $row)
    {
       
       if (!isset($row[0]) || empty(trim($row[0]))) {

        return null;
    }

    return new Item([
        'name' => $row[0],
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    }

    public function rules(): array
    {
        return [
            '0' => 'required', 
        ];
    }
}
