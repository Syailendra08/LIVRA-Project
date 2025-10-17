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
    ]);


    $photoPath = null;
    if ($request->hasFile('photo')) {
        $photoPath = $request->file('photo')->store('plants', 'public');
    }


    $plant = Plant::create([
       'user_id' => auth()->id(),
    'category_id' => $validated['category_id'],
    'plant_name' => $validated['plant_name'],
    'latin_name' => $validated['latin_name'] ?? null,
    'location' => $validated['location'],
    'stock' => $validated['stock'],
    'description' => $validated['description'] ?? null,
    'photo' => $photoPath,
    'barcode' => 'barcode-' . uniqid() . '.svg',
    'condition' => $validated['condition'] ?? null,
    'habitat' => $validated['habitat'] ?? null,
    'health_benefits' => $validated['health_benefits'] ?? null,
    'cultural_benefits' => $validated['cultural_benefits'] ?? null,
    ]);


    \SimpleSoftwareIO\QrCode\Facades\QrCode::format('svg')
        ->size(200)
        ->generate(route('admin.plants.show', $plant->id), public_path('qrcodes/' . $plant->barcode));


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

    return view('admin.plants.show', compact('plant'));
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
    public function destroy($id)
    {
    $plant = Plant::findOrFail($id);

    // ✅ Hapus foto jika ada
    if ($plant->photo && Storage::disk('public')->exists($plant->photo)) {
        Storage::disk('public')->delete($plant->photo);
    }

    // ✅ Hapus barcode QR jika ada
    if ($plant->barcode && Storage::disk('public')->exists($plant->barcode)) {
        // pastikan barcode adalah file, bukan folder
        $barcodePath = Storage::disk('public')->path($plant->barcode);
        if (is_file($barcodePath)) {
            unlink($barcodePath);
        }
    }

    // ✅ Hapus data dari database
    $plant->delete();

    return redirect()->route('admin.plants.index')->with('success', 'Plant deleted successfully.');
}

    public function exportExcel()
    {
        $fileName = 'data-plants.xlsx';
        return \Excel::download(new PlantExport, $fileName);
    }
}
