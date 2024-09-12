<?php

namespace App\Exports;

use Modules\Items\Models\Item;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ItemsExport implements FromCollection, WithHeadings
{
    // retrieves the data from the `items` table
    public function collection()
    {
        return Item::select('id', 'name', 'completed', 'completed_at', 'created_at', 'updated_at')->get();
    }

    // defines the headers for the Excel file
    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Completed',
            'Completed At',
            'Created At',
            'Updated At',
        ];
    }
}
