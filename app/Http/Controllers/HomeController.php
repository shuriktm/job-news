<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show all the news.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $posts = Post::public()
            ->paginate(10);

        $categories = Category::public()->get();

        return view('home.feed', [
            'posts' => $posts,
            'categories' => $categories->take(20),
            'more' => $categories->skip(20),
            'title' => __('All'),
        ]);
    }

    /**
     * Show news for the specified category.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function category(Request $request, Category $category)
    {
        $posts = $category->posts()
            ->public()
            ->paginate(10);

        $categories = Category::public()->get();

        return view('home.feed', [
            'posts' => $posts,
            'categories' => $categories->take(20),
            'more' => $categories->skip(20),
            'title' => $category->title,
        ]);
    }

    /**
     * Show the post content.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function post(Request $request, Category $category, Post $post)
    {
        $categories = Category::public()->get();

        return view('home.post', [
            'category' => $category,
            'post' => $post,
            'categories' => $categories->take(20),
            'more' => $categories->skip(20),
        ]);
    }
}
