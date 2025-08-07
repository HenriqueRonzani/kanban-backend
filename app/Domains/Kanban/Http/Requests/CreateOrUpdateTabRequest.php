<?php

namespace App\Domains\Kanban\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateOrUpdateTabRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'color' => 'required|string|max:20',
            'action_on_move' => 'nullable|string|in:finish,cancel'
        ];
    }
}
