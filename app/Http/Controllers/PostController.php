<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Support\CategoryCollection;
use Illuminate\Database\Eloquent\Builder;

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

        $categories = Category::manage()
            ->withTrashed()
            ->withWhereHas('posts');

        return view('post.index', $this->prepareGridData($posts, $categories));
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

        $categories = Category::manage()
            ->withTrashed()
            ->withWhereHas('posts', function ($query) {
                $query->onlyTrashed();
            });

        return view('post.archive', $this->prepareGridData($posts, $categories));
    }

    /**
     * Prepare data to render table.
     *
     * @param  Builder  $posts
     * @param  Builder  $categories
     * @return array
     */
    protected function prepareGridData(Builder $posts, Builder $categories)
    {
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

        $categories = $categories->get();
        /* @var $categories CategoryCollection */

        return ['posts' => $posts, 'categories' => $categories->options()];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create()
    {
        $categories = Category::manage()->get();
        /* @var $categories CategoryCollection */

        return view('post.create', ['categories' => $categories->options()]);
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
        $categories = Category::manage()
            ->withTrashed()
            ->get();
        /* @var $categories CategoryCollection */

        return view('post.edit', ['categories' => $categories->options(), 'post' => $post]);
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
