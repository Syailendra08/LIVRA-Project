<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plant;
use App\Models\PlantCategory;
use App\Models\PlantTip;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Exports\PlantExport;
use Maatwebsite\Excel\Facades\Excel;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class PlantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $plants = Plant::with(['category','tip'])->latest()->get();

        return view('admin.plants.index', compact ('plants'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = PlantCategory::all();
        $tips = PlantTip::all();

        return view('admin.plants.create', compact('categories', 'tips'));
    }

    /**
     * Store a newly created resource in storage.
     */


public function store(Request $request)
{
    $validated = $request->validate([
        'plant_name' => 'required|string|max:255',
        'latin_name' => 'nullable|string|max:255',
        'category_id' => 'required|exists:plant_categories,id',
        'location' => 'required|string|max:255',
        'habitat' => 'required|string|max:255',
        'stock' => 'required|integer|min:0',
        'condition' => 'required|string',
        'health_benefits' => 'required|string',
        'cultural_benefits' => 'required|string',
        'description' => 'nullable|string',
        'photo' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        'watering' => 'nullable|string',
        'lighting' => 'nullable|string',
        'growing_media' => 'nullable|string',
    ], [
        'plant_name.required' => 'The plant name field is required.',
        'plant_name.string' => 'The plant name must be a string.',
        'plant_name.max' => 'The plant name may not be greater than 255 characters.',
        'category_id.required' => 'The category field is required.',
        'category_id.exists' => 'The selected category is invalid.',
        'location.required' => 'The location field is required.',
        'location.string' => 'The location must be a string.',
        'location.max' => 'The location may not be greater than 255 characters.',
        'stock.required' => 'The stock field is required.',
        'stock.integer' => 'The stock must be an integer.',
        'stock.min' => 'The stock must be at least 0.',
        'condition.required' => 'The condition field is required.',
        'health_benefits.required' => 'The health benefits field is required.',
        'cultural_benefits.required' => 'The cultural benefits field is required.',
        'photo.image' => 'The photo must be an image.',
        'photo.mimes' => 'The photo must be a file of type: jpg, png, jpeg.',
        'photo.max' => 'The photo may not be greater than 2048 kilobytes.',

    ]);


   $photo = $request->file('photo');
   $photoName = Str::random(5) . '-plant.' . $photo->getClientOriginalExtension();
   $path = $photo->storeAs('plants', $photoName, 'public');



    $plant = Plant::create([
       'user_id' => auth()->id(),
    'category_id' => $validated['category_id'],
    'plant_name' => $validated['plant_name'],
    'latin_name' => $validated['latin_name'] ?? null,
    'location' => $validated['location'],
    'stock' => $validated['stock'],
    'description' => $validated['description'] ?? null,
    'photo' => $path,
    'barcode' => 'barcode-' . uniqid() . '.svg',
    'condition' => $validated['condition'] ?? null,
    'habitat' => $validated['habitat'] ?? null,
    'health_benefits' => $validated['health_benefits'] ?? null,
    'cultural_benefits' => $validated['cultural_benefits'] ?? null,
    ]);


    if (!Storage::exists('public/qrcodes')) {
    Storage::makeDirectory('public/qrcodes');
}

$qrCode = QrCode::format('svg')
    ->size(200)
    ->generate(route('plants.show', $plant->id));

Storage::disk('public')->put('qrcodes/' . $plant->barcode . '.svg', $qrCode);

    if ($request->filled('watering') || $request->filled('lighting') || $request->filled('growing_media')) {
        $plant->tip()->create([
            'watering' => $validated['watering'] ?? null,
            'lighting' => $validated['lighting'] ?? null,
            'growing_media' => $validated['growing_media'] ?? null,
        ]);
    }

    return redirect()->route('admin.plants.index')->with('success', 'Plant created successfully!');
}







    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $plant = Plant::findOrFail($id);

    return view('plants.show', compact('plant'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $plant = Plant::find($id);
        $categories = PlantCategory::all();
        $tips = PlantTip::all();
        return view('admin.plants.edit', compact('plant', 'categories', 'tips'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'plant_name' => 'required|string|max:255',
        'latin_name' => 'nullable|string|max:255',
        'category_id' => 'required|exists:plant_categories,id',
        'location' => 'required|string|max:255',
        'habitat' => 'required|string|max:255',
        'stock' => 'required|integer|min:0',
        'condition' => 'required|string',
        'health_benefits' => 'required|string',
        'cultural_benefits' => 'required|string',
        'description' => 'nullable|string',
        'photo' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        'watering' => 'nullable|string',
        'lighting' => 'nullable|string',
        'growing_media' => 'nullable|string',
    ], [
        'plant_name.required' => 'The plant name field is required.',
        'plant_name.string' => 'The plant name must be a string.',
        'plant_name.max' => 'The plant name may not be greater than 255 characters.',
        'category_id.required' => 'The category field is required.',
        'category_id.exists' => 'The selected category is invalid.',
        'location.required' => 'The location field is required.',
        'location.string' => 'The location must be a string.',
        'location.max' => 'The location may not be greater than 255 characters.',
        'stock.required' => 'The stock field is required.',
        'stock.integer' => 'The stock must be an integer.',
        'stock.min' => 'The stock must be at least 0.',
        'condition.required' => 'The condition field is required.',
        'health_benefits.required' => 'The health benefits field is required.',
        'cultural_benefits.required' => 'The cultural benefits field is required.',
        'photo.image' => 'The photo must be an image.',
        'photo.mimes' => 'The photo must be a file of type: jpg, png, jpeg.',
        'photo.max' => 'The photo may not be greater than 2048 kilobytes.',

    ]);
    $plant = Plant::find($id);
    if ($request->file('photo')) {
        $lastFile = storage_path('app/public/' . $plant->photo);
        if (file_exists($lastFile)) {
            unlink($lastFile);
        }
        $photo = $request->file('photo');
   $photoName = Str::random(5) . '-plant.' . $photo->getClientOriginalExtension();
   $path = $photo->storeAs('plants', $photoName, 'public');

    }
    $updateData = Plant::where('id', $id)->update([
        'user_id' => auth()->id(),
    'category_id' => $validated['category_id'],
    'plant_name' => $validated['plant_name'],
    'latin_name' => $validated['latin_name'] ?? null,
    'location' => $validated['location'],
    'stock' => $validated['stock'],
    'description' => $validated['description'] ?? null,
    'photo' => $path ?? $plant['photo'],
    'condition' => $validated['condition'] ?? null,
    'habitat' => $validated['habitat'] ?? null,
    'health_benefits' => $validated['health_benefits'] ?? null,
    'cultural_benefits' => $validated['cultural_benefits'] ?? null,

    ]);
    if($updateData) {
        return redirect()->route('admin.plants.index')
                ->with('success', 'Plant updated successfully');
        } else {
            return redirect()->back()->with('error', 'Failed, Please Try again!');
        }
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    $plant = Plant::findOrFail($id);

    $plant->delete();

    return redirect()->route('admin.plants.index')->with('success', 'Plant deleted successfully.');
}

    public function exportExcel()
    {
        $fileName = 'data-plants.xlsx';
        return \Excel::download(new PlantExport, $fileName);
    }
    public function trash()
{
    $plantTrash = Plant::onlyTrashed()->with(['category', 'tip'])->get();
    return view('admin.plants.trash', compact('plantTrash'));
}

public function restore($id)
{
    $plant = Plant::onlyTrashed()->findOrFail($id);
    $plant->restore();

    return redirect()->route('admin.plants.trash')
        ->with('success', 'Plant restored successfully.');
}

public function deletePermanent($id)
{
    $plant = Plant::onlyTrashed()->findOrFail($id);

    // Hapus file photo & barcode jika masih ada
    if ($plant->photo && Storage::disk('public')->exists($plant->photo)) {
        Storage::disk('public')->delete($plant->photo);
    }

    if ($plant->barcode && Storage::disk('public')->exists('qrcodes/' . $plant->barcode . '.svg')) {
        Storage::disk('public')->delete('qrcodes/' . $plant->barcode . '.svg');
    }

    // Hapus permanen dari database
    $plant->forceDelete();

    return redirect()->back()->with('success', 'Plant permanently deleted.');
}

    public function dataChart()
    {
      // Ambil semua kategori + jumlah tanaman per kategori
    $categories = PlantCategory::withCount('plants')->get();

    // Hitung total tanaman
    $totalPlants = Plant::count();

    // Siapkan label dan data persentase
    $labels = [];
    $data = [];

    foreach ($categories as $category) {
        $labels[] = $category->category_name;

        // Hitung persentase
        $percentage = $totalPlants > 0
            ? ($category->plants_count / $totalPlants) * 100
            : 0;

        // simpan hasil count ke array data
        $data[] = round($percentage, 2);
    }

    return response()->json([
        'labels' => $labels,
        'data'   => $data
    ]);
    }

    public function gallery(Request $request)
{
    $search = $request->input('search_plant');
    $sort   = $request->query('sort');

    $plants = Plant::with('category')
        ->when($search, function ($query) use ($search) {
            $query->where('plant_name', 'like', '%' . $search . '%')
                  ->orWhere('location', 'like', '%' . $search . '%');
        });

    // Sorting plant
    switch ($sort) {
        case 'alphabet':
            $plants->orderBy('plant_name', 'asc');
            break;

        case 'category':
            $plants->orderBy(
                Category::select('category_name')
                    ->whereColumn('categories.id', 'plants.category_id')
            );
            break;

        case 'newest':
            $plants->orderBy('created_at', 'desc');
            break;

        case 'oldest':
            $plants->orderBy('created_at', 'asc');
            break;
    }

    $plants = $plants->get();

    return view('gallery', compact('plants', 'search', 'sort'));
}

}
