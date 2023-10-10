<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class SendLikeRequest extends FormRequest
{


    public function rules(): array
    {
        return [
            'from_id' => [
                'required',
                'integer',
                'exists:users,id'
            ]
        ];
    }
}
