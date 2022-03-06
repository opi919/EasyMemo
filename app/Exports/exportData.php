<?php

namespace App\Exports;

use App\Models\Orders;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;

class exportData implements FromCollection
{
    function __construct($order) {
        $this->order = $order;
 }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->order;
    }
}
