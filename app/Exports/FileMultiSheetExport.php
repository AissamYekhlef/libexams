<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class FileMultiSheetExport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            //
        ];
    }
}
