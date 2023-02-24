<?php

namespace App\Http\Requests\API\V1\Blog;

use Illuminate\Foundation\Http\FormRequest;

class CategoryCreateRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title'       => 'required|min:5|max:200|unique:blog_categories',
            'slug'        => 'max:200|unique:blog_categories',
            'description' => 'max:500',
            'parent_id'   => 'required|integer|exists:blog_categories,id',
        ];
    }
}
