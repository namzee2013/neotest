<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuestionRequest extends FormRequest
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
            'category_id' => 'required',
            'question'    => 'required'
        ];
        $option = $this->option;
        $type = $this->type;
        if($type != 3 && $option == null){
            $rules['option'] = 'required';
        }
        return $rules;
    }
    public function messages()
    {
        return[
            'question.required'    => 'Please insert content question',
            'category_id.required' => 'Please choose Category of question',
            'option.required'      => 'Please insert Option of question',
        ];
    }
}
