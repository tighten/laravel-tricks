<?php

namespace App\Http\Requests;

use App\Models\Trick;
use Illuminate\Foundation\Http\FormRequest;

class TrickRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->routeIs('tricks.store') ?
            $this->user()->can('create', Trick::class) :
            $this->user()->can('update', $this->trick);
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'min:4', 'unique:tricks,name'],
            'description' => ['required', 'min:10'],
            'code' => ['required'],
            'tags' => ['required', 'array'],
        ];
    }

    protected function prepareForValidation(): void
    {
        if (isset($this->tags) && is_string($this->tags)) {
            $this->merge([
                'tags' => explode(',', $this->tags),
            ]);
        }
    }
}
