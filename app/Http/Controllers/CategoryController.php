<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = Category::options()
            ->paginate(10)
            ->withQueryString();

        return view('category.index', ['categories' => $categories]);
    }

    /**
     * Display a listing of the deleted resource.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function archive()
    {
        $categories = Category::options()
            ->onlyTrashed()
            ->paginate(10)
            ->withQueryString();

        return view('category.archive', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CategoryRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CategoryRequest $request)
    {
        $category = Category::create($request->validated());

        session()->put('status', __('Category ":title" has been created.', ['title' => $category->title]));

        return redirect()->route('categories.edit', $category);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('category.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CategoryRequest  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $category->fill($request->validated());
        $category->saveOrFail();

        session()->put('status', __('Category ":title" has been updated.', ['title' => $category->title]));

        return redirect()->route('categories.edit', $category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();

        session()->put('status', __('Category ":title" has been deleted.', ['title' => $category->title]));

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
        $category = Category::onlyTrashed()->find($id);

        if ($category) {
            $category->restore();

            session()->put('status', __('Category ":title" has been restored.', ['title' => $category->title]));
        }

        return redirect()->route('categories.edit', $category);
    }
}
