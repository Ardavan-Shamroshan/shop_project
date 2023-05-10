<?php

namespace App\Http\Requests\Admin\Ticket;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TicketRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'subject'     => 'required|max:2048|min:2',
            'description' => 'required|max:2048|min:2',
            'priority_id' => ['required', Rule::exists('ticket_priorities', 'id')],
            'category_id' => ['required', Rule::exists('ticket_categories', 'id')]
        ];
    }
}
