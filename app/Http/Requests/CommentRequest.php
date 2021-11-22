<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    // public function authorize()
    // {
    //     return true;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'comment_body' => 'required|string|max:10000'
        ];
    }
    // public function messages()
    // {
    //     return [
    //         'body.required' => 'コメント本文を入力してください',
    //         'body.max' => 'コメント本文は10000文字以内で入力してください。'
    //     ];
        
    // }
}
