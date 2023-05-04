<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\UnitRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::latest()->paginate(PAGINATION_COUNT);
        return view('dashboard.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UnitRequest $request)
    {
        $data = $request->all();
        Category::create($data);
        return redirect()->route('categories.index')
            ->with(['success' => trans('admin.added')]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::find($id);
        return view('dashboard.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::orderBy('id', 'DESC')->find($id);
        return view('dashboard.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UnitRequest $request, string $id)
    {
        $category = Category::find($id);
        $data = $request->all();
        $category->fill($data)->save();
        return redirect()->route('categories.index')
            ->with(['success' => trans('admin.updated')]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $category = Category::orderBy('id', 'DESC')->find($id);
            if (!$category)
                return redirect()->route('categories.index')->with(['error' => trans('admin.coun_not_found')]);
            $category->delete();
            return redirect()->route('categories.index')->with(['success' =>  trans('admin.detelted_sucess')]);
        } catch (\Exception $ex) {
            return redirect()->route('categories.index')->with(['error' =>  trans('admin.try_again')]);
        }
    }
}
