<?php

namespace App\Exports;

use Modules\Items\Models\Item;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Facades\Auth;

class ItemsExport implements FromQuery, WithHeadings, WithChunkReading, WithMapping
{
    // Retrieve the data from the `items` table in batches
    public function query()
    {
        return Item::select('id', 'name', 'completed_at', 'status', 'created_at', 'updated_at')
            ->where('user_id', Auth::id());
    }

    // Define the headers for the Excel file
    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Completed At',
            'status',
            'Created At',
            'Updated At',
        ];
    }

    // Define the chunk size for batch processing
    public function chunkSize(): int
    {
        return 100; 
    }

    // Define how each row should be mapped in the Excel export
    public function map($item): array
    {
        return [
            $item->id,
            $item->name,
            $item->completed_at,
            $item->status,
            $item->created_at,
            $item->updated_at,
        ];
    }
}
