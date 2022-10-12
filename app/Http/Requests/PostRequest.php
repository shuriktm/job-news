<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PostRequest extends FormRequest
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
        $post = $this->route('post');

        return [
            'category_id' => 'required|int|exists:categories,id',
            'title' => 'required|max:255',
            'slug' => [
                'required',
                'max:255',
                $post ? Rule::unique('posts')->ignoreModel($post)
                    : Rule::unique('posts'),
            ],
            'content' => 'string',
            'publish_at' => 'required|date',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'category_id' => __('Category'),
            'title' => __('Title'),
            'slug' => __('Slug'),
            'content' => __('Content'),
            'publish_at' => __('Publish At'),
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'slug' => Str::slug($this->slug ? : $this->title),
        ]);
    }
}
