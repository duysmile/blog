<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreArticle extends FormRequest
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
            'title' => 'bail|unique:articles,title,{id},id,deleted_at,NULL|required|string|max:256',
            'content' => 'required',
            'thumbnail' => 'required',
            'time_public' => 'required',
        ];
    }
}
