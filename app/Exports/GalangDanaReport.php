<?php
namespace App\Exports;

use App\Model\GalangDana;
use Maatwebsite\Excel\Concerns\FromCollection;
​
class GalangDanaReport implements FromCollection
{
    public function collection()
    {
        return GalangDana::all();
    }
}