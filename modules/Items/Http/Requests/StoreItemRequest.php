<?php

namespace Modules\Items\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreItemRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'item.name' => 'required|string|max:255',
        ];
    }
}