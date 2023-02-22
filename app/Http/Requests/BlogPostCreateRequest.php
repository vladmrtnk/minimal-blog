<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogPostCreateRequest extends FormRequest
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
            'title'        => 'required|min:5|max:200|unique:blog_posts',
            'slug'         => 'max:200|unique:blog_posts',
            'user_id'      => 'required|integer|exists:users,id',
            'category_id'  => 'required|integer|exists:blog_categories,id',
            'excerpt'      => 'max:500',
            'content_raw'  => 'required',
            'content_html' => 'required',
            'is_published' => 'bool',
            'published_at' => 'date'
        ];
    }
}
