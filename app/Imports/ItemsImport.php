<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithValidation;
use Generator;
use Modules\Items\Models\Item;

class ItemsImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        // Iterate over the generator and handle each row
        foreach ($this->processRows($rows) as $data) {
            if (!isset($data[0]) || empty(trim($data[0]))) {
                continue;
            }

            Item::create([
                'name' => $data[0],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    // A generator function that yields rows one by one.
    public function processRows(Collection $rows): Generator
    {
        foreach ($rows as $row) {
            yield $row;
        }
    }

    public function rules(): array
    {
        return [
            '0' => 'required|string',
        ];
    }
}
