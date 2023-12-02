<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\In;
use Illuminate\Validation\Rules\ProhibitedIf;
use Illuminate\Validation\Rules\RequiredIf;
use Illuminate\Validation\Rules\Unique;
use Modules\Task\Enums\TaskStatusEnum;

class CreateTaskRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:30',
                (new Unique('tasks', 'name'))
                    ->where(
                        'user_id',
                        request()->get('user_id') ?: request()->user()->id
                    )
            ],
            'description' => ['nullable', 'string', 'max:255'],
            'status' => ['nullable', 'string', new In(TaskStatusEnum::toArray())],
            'user_id' => [
                new ProhibitedIf(fn () => !request()->user()->isAdmin()),
                new RequiredIf(fn () => request()->user()->isAdmin()),
                'integer',
                'exists:users,id'
            ],
        ];
    }
}
