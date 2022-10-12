<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $posts = Post::published()
            ->paginate(10);

        $categories = Category::options()->get();

        return view('home', [
            'posts' => $posts,
            'categories' => $categories,
        ]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function category(Request $request, Category $category)
    {
        $posts = $category->posts()
            ->published()
            ->paginate(10);

        $categories = Category::options()->get();

        return view('home', [
            'posts' => $posts,
            'categories' => $categories,
            'header' => $category->title,
        ]);
    }
}
