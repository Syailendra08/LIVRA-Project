<?php

namespace App\Exports;

use App\Models\PlantCategory;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class CategoriesExport implements FromCollection, WithHeadings, WithMapping
{
    private $rowNumber = 0;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return PlantCategory::all();
    }
    public function headings(): array
    {
        return [
            'No',
            'Category Name',
            'Description',

        ];
    }
    public function map($category): array
    {
        return [
            ++$this->rowNumber,
            $category->category_name,
            $category->description,
        ];
    }
}
