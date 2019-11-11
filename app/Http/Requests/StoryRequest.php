<?php

namespace App\Http\Requests;

use App\Story;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoryRequest extends FormRequest
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
        $rules = [
            'body' => 'required|string',
            'author' => 'required|string|max:255',
            'is_premium' => 'required|numeric',
            'age' => array(
                'required',
                'regex:/([0-9]-[0-9])/'
            ),
            'category_id' => 'required|numeric|exists:categories,id',
            'photo' => 'nullable|mimes:jpeg,jpg,png|max:2000', //Max 2MB
        ];

        $rules['title'] = in_array($this->method(), ['PATCH', 'PUT']) ?

            'required|string|max:255|unique:stories,title,' . $this->id
            //Rule::unique('stories')->ignore($this->id)
            : 'required|string|unique:stories|max:255';

        //dd($rules);

        return $rules;
    }
}
