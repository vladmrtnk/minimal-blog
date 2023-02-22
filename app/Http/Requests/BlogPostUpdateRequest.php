<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogPostUpdateRequest extends FormRequest
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
            'title'        => 'min:5|max:200|unique:blog_posts',
            'slug'         => 'max:200|unique:blog_posts',
            'user_id'      => 'integer|exists:users,id',
            'category_id'  => 'integer|exists:blog_categories,id',
            'excerpt'      => 'max:500',
            'content_raw'  => '',
            'content_html' => '',
            'is_published' => 'bool',
            'published_at' => 'date'
        ];
    }
}
