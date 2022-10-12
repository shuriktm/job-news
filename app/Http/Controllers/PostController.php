<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = Post::manage();

        if ($categoryId = request()->input('category')) {
            $posts->where('category_id', $categoryId);
        }
        if ($search = request()->input('search')) {
            $posts->where(function ($query) use ($search) {
                $query->where('title', 'like', "%$search%")
                    ->orWhere('slug', 'like', "%$search%");
            });
        }

        $posts = $posts->paginate(10)
            ->withQueryString();

        $categories = Category::options()
            ->withWhereHas('posts')
            ->get()
            ->mapWithKeys(fn(Category $category) => [$category->id => $category->title]);

        return view('post.index', [
            'posts' => $posts,
            'categories' => $categories,
        ]);
    }

    /**
     * Display a listing of the deleted resource.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function archive()
    {
        $posts = Post::manage()
            ->onlyTrashed();

        if ($categoryId = request()->input('category')) {
            $posts->where('category_id', $categoryId);
        }
        if ($search = request()->input('search')) {
            $posts->where(function ($query) use ($search) {
                $query->where('title', 'like', "%$search%")
                    ->orWhere('slug', 'like', "%$search%");
            });
        }

        $posts = $posts->paginate(10)
            ->withQueryString();

        $categories = Category::options()
            ->withWhereHas('posts', function ($query) {
                $query->onlyTrashed();
            })
            ->get()
            ->mapWithKeys(fn(Category $category) => [$category->id => $category->title]);

        return view('post.archive', [
            'posts' => $posts,
            'categories' => $categories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create()
    {
        $categories = Category::options()->get()
            ->mapWithKeys(fn(Category $category) => [$category->id => $category->title]);

        return view('post.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\PostRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PostRequest $request)
    {
        $post = Post::create($request->validated());

        session()->put('status', __('Post ":title" has been created.', ['title' => $post->title]));

        return redirect()->route('posts.edit', $post);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit(Post $post)
    {
        $categories = Category::options()->get()
            ->mapWithKeys(fn(Category $category) => [$category->id => $category->title]);

        return view('post.edit', ['categories' => $categories, 'post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\PostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PostRequest $request, Post $post)
    {
        $post->fill($request->validated());
        $post->saveOrFail();

        session()->put('status', __('Post ":title" has been updated.', ['title' => $post->title]));

        return redirect()->route('posts.edit', $post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Post $post)
    {
        $post->delete();

        session()->put('status', __('Post ":title" has been deleted.', ['title' => $post->title]));

        return back();
    }

    /**
     * Restore the specified resourcee.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore($id)
    {
        $post = Post::onlyTrashed()->find($id);

        if ($post) {
            $post->restore();

            session()->put('status', __('Post ":title" has been restored.', ['title' => $post->title]));
        }

        return redirect()->route('posts.edit', $post);
    }
}
