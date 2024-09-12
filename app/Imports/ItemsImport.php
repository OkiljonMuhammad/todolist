<?php

namespace App\Imports;

use Modules\Items\Models\Item;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;


class ItemsImport implements ToModel, WithChunkReading
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

    public function chunkSize(): int
    {
        return 100; 
    }
}
