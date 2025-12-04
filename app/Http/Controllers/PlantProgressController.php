<?php

namespace App\Http\Controllers;
use App\Models\Plant;
use App\Models\PlantCategory;
use App\Models\PlantProgress;
use Illuminate\Http\Request;

class PlantProgressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
          $categories = PlantCategory::all();


          $plants = Plant::with(['category', 'progresses'])->get();

    return view('staff.progresses.index', compact('plants', 'categories'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'plant_id' => 'required',
            'description' => 'required',
            'progress_type' => 'required',
            'progress_date' => 'required',

        ], [
            'category_id.required' => 'You need to choose category',
            'plant_id.required' => 'You need to choose plant',
            'description.required' => 'Description is required',
            'progress_type.required' => 'Progress is required',
            'progress_date.required' => 'Progress date is required',
        ]);

        $createData = PlantProgress::create([
            'category_id' => $request->category_id,
            'plant_id' => $request->plant_id,
            'description' => $request->description,
            'progress_type'=> $request->progress_type,
            'progress_date' => $request->progress_date,

        ]);
        if ($createData) { // Melibatkan lebih dari satu operasi data, masuk kriteria transaksi
        $plant = Plant::find($request->plant_id);
        if ($plant) {
            $plant->status = $request->progress_type;
            $plant->save();
        }

        return redirect()->route('staff.progress.index')->with('success', 'Progress has been added and plant status updated.');
    } else {
        return redirect()->back()->with('failed', 'Progress failed to added.');
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
        // Ambil progress ID yang diklik
    $progress = PlantProgress::find($id);

    if (!$progress) {
        abort(404, 'Progress not found');
    }

    // Ambil plant berdasarkan progress->plant_id
    $plant = Plant::find($progress->plant_id);

    // Ambil kategori untuk dropdown
    $categories = PlantCategory::all();

    return view('staff.progresses.edit', compact('plant', 'progress', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'description' => 'required',
            'progress_type' => 'required',
            'progress_date' => 'required',

        ], [
            'description.required' => 'Description is required',
            'progress_type.required' => 'Progress is required',
            'progress_date.required' => 'Progress date is required',
        ]);
        $updateData = PlantProgress::where('progress_id', $id)->update([
        'description'    => $request->description,
            'progress_type'  => $request->progress_type,
        'progress_date'  => $request->progress_date,
        ]);

        if($updateData){
            return redirect()->route('staff.progress.index')->with('success', 'Progress update successfully!');
        }else {
            return redirect()->back()->with('error', 'failed! please try again');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $progress = PlantProgress::findOrFail($id);
        $progress->delete();

    return redirect()->back()->with('success', 'Progress has been deleted succesfully!');
    }

    public function trash()
    {
        $progressTrash = PlantProgress::onlyTrashed()
        ->with(['plant', 'category'])
        ->get();

    return view('staff.progresses.trash', compact('progressTrash'));
    }

    public function restore($id)
{
    $progress = PlantProgress::onlyTrashed()->where('progress_id', $id)->firstOrFail();
    $progress->restore();

    return redirect()->back()->with('success', 'Progress has been restored!');
}

public function deletePermanent($id)
{
    $progress = PlantProgress::onlyTrashed()->where('progress_id', $id)->firstOrFail();
    $progress->forceDelete();

    return redirect()->back()->with('success', 'Progress permanently deleted!');
}

}
