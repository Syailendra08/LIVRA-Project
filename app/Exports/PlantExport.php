<?php

namespace App\Exports;


use App\Models\Plant;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromCollection;

class PlantExport implements FromCollection, WithHeadings, WithMapping
{
    private $key = 0;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Plant::all();
    }

    public function headings(): array
    {
        return [
            'No',
            'Plant Name',
            'Stock',
            'Category',
            'Location',
            'Image',

        ];
    }
    public function map($plant): array
    {
        $this->key++;
        return [
            $this->key,
            $plant->plant_name,
            $plant->stock,
            $plant->category ? $plant->category->category_name : 'N/A',
            $plant->location,

            asset('storage/plants/' . $plant->image),
        ];
    }
}
