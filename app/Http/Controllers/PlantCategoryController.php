<?php

namespace App\Http\Controllers;
use App\Exports\CategoriesExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Models\PlantCategory;

class PlantCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = PlantCategory::all();
        $lastUpdate = PlantCategory::latest('updated_at')->first();
        return view('admin.category.index', compact('categories', 'lastUpdate'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ], [
            'category_name.required' => 'The category name field is required.',
            'category_name.string' => 'The category name must be a string.',
            'category_name.max' => 'The category name may not be greater than 255 characters.',
            'description.string' => 'The description must be a string.',
        ]);

        $createdCategory = PlantCategory::create([
            'category_name' => $request->input('category_name'),
            'description' => $request->input('description'),
        ]);

        if ($createdCategory) {
            return redirect()->route('admin.category.index')->with('success', 'Category created successfully.');
        } else {
            return back()->with('error', 'Failed to create category. Please try again.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $deleteData = PlantCategory::where('id', $id)->delete();
        if ($deleteData) {
            return redirect()->route('admin.category.index')->with('success', 'Category deleted successfully.');
    }
        else {
            return redirect()->back()->with('error', 'Failed to delete category. Please try again.');
        }
    }

    public function exportExcel()
    {
        $fileName = 'categories_' . date('Y_m_d_H_i_s') . '.xlsx';
        return \Excel::download(new CategoriesExport, $fileName);
    }
}
