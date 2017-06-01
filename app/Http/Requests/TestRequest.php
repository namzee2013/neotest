<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TestRequest extends FormRequest
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
            'category_id' => 'required',
            'qOneQuest'   => 'required', 
            'qMultiQuest' => 'required',
            'qTextQuest'  => 'required',
            'timetotal'   => 'required',
            'expired'     => 'required',
        ];
    }
    public function messages()
    {
        return [
            'category_id.required' => 'Please select Category of test',
            'qOneQuest.required'   => 'Please enter quantity of One-choice Question', 
            'qMultiQuest.required' => 'Please enter quantity of Multi-choice Question',
            'qTextQuest.required'  => 'Please enter quantity of Text Question',
            'timetotal.required'   => 'Please enter time total of test',
            'expired.required'     => 'Please enter time expired of test',
        ];
    }
}
