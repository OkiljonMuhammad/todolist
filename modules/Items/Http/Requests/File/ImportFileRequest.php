<?php

namespace Modules\Items\Http\Requests\File;

use Illuminate\Foundation\Http\FormRequest;

class ImportFileRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'file' => 'required|mimes:xlsx,xls,csv|max:2048',
        ];
    }
}