<?php

namespace Modules\Items\Http\Requests\Item;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ItemValidateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'item.name' => 'required|string|max:255',
        ];
    }

    public function authorize()
    {
        return true;
    }
}