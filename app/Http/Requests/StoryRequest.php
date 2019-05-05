<?php

namespace App\Http\Requests;

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
            'is_premium' => 'required|numeric|max:255',            
            'age' => 'required|string|max:255',
            'category_id' => 'required|numeric|max:255',            
            'photo'=>'nullable|mimes:jpeg,jpg,png|max:800', //Max 800KB
        ];

        $rules['title'] =$this->method() == 'PUT'?
        [
            'required','string','max:255', 
            Rule::unique('stories')
                ->ignore($this->route('story')->id)
        ]:'required|string|unique:stories|max:255';
        
        return $rules;
    }
}
