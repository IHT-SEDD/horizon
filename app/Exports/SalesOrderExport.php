<?php

namespace App\Exports;

use App\Models\Sales;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SalesOrderExport implements FromCollection, WithHeadings
{
    protected $sales;

    public function __construct($sales)
    {
        $this->sales = $sales;
    }

    public function collection()
    {
        return collect($this->sales->salesProducts)->map(function ($item) {
            return [
                'Product'  => $item->product_name,
                'Quantity' => $item->quantity,
                'Unit'     => $item->unit,
                'Price'    => $item->unit_price,
                'Total'    => $item->total,
            ];
        });
    }

    public function headings(): array
    {
        return ['Product', 'Quantity', 'Unit', 'Price', 'Total'];
    }
}
