<?php

namespace Modules\Items\Http\Requests\Item;

use Illuminate\Foundation\Http\FormRequest;

class ItemValidateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'item.name' => 'required|string|max:255',
        ];
    }
}