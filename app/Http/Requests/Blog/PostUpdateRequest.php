<?php

namespace App\Http\Requests\Blog;

use Illuminate\Foundation\Http\FormRequest;

class PostUpdateRequest extends FormRequest
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
            'title'        => 'required|min:5|max:200',
            'slug'         => 'max:200',
            'category_id'  => 'required|integer|exists:blog_categories,id',
            'excerpt'      => 'max:500',
            'content'      => 'required',
            'is_published' => 'bool',
            'published_at' => 'date'
        ];
    }
}
