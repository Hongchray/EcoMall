<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Models\SubCategoryTranslation;
class SubcategoryController extends Controller
{

    public function index(Request $request)
    {
        $sort_search = null;

        $subcategories = Subcategory::orderBy('id', 'desc');

        if ($request->has('search')) {

            $sort_search = $request->search;

            $subcategories = $subcategories->where(
                'name',
                'like',
                '%'.$sort_search.'%'
            );
        }

        $subcategories = $subcategories->paginate(15);

        return view(
            'backend.product.subcategory.index',
            compact('subcategories', 'sort_search')
        );
    }

    public function create()
    {
        $categories = Category::all();

        return view('backend.product.subcategory.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|max:255',
        ]);

        $subcategory = new SubCategory;

        $subcategory->category_id = $request->category_id;
        $subcategory->slug = Str::slug($request->name);
        $subcategory->image = $request->image;
        $subcategory->description = $request->description;
        $subcategory->name = $request->name;

        $subcategory->save();

        $translation = new SubCategoryTranslation;
        $translation->subcategory_id = $subcategory->id;
        $translation->name = $request->name;
        $translation->lang = env('DEFAULT_LANGUAGE');
        $translation->save();

        return redirect()->route('subcategories.index')
            ->with('success', 'Subcategory created successfully.');
    }

    public function edit(SubCategory $subcategory, Request $request)
    {
        $lang = $request->lang;

        $subcategory = SubCategory::findOrFail($subcategory->id);

        $categories = Category::orderBy('name', 'asc')->get();

        return view(
            'backend.product.subcategory.edit',
            compact('subcategory', 'categories', 'lang')
        );
    }

    public function update(Request $request, SubCategory $subcategory)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|max:255',
        ]);

        $subcategory->category_id = $request->category_id;
        $subcategory->image = $request->image;
        $subcategory->description = $request->description;
        $subcategory->name = $request->name;

        if ($request->slug) {
            $subcategory->slug = Str::slug($request->slug);
        } else {
            $subcategory->slug = Str::slug($request->name) . '-' . Str::random(5);
        }

        $subcategory->save();

        // translation (same pattern as Category)
        $translation = SubCategoryTranslation::firstOrNew([
            'subcategory_id' => $subcategory->id,
            'lang' => $request->lang ?? env('DEFAULT_LANGUAGE'),
        ]);

        $translation->name = $request->name;
        $translation->save();

        return back()->with('success', 'Subcategory updated successfully');
    }

    public function destroy($id)
    {
        return redirect()
            ->route('subcategories.index')
            ->with('success', 'Subcategory deleted successfully.');
    }
}
