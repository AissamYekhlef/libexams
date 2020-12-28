<?php

namespace App\Exports;

use App\Models\File;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet;

class FileExport implements 
    FromQuery,
    WithHeadings,
    WithMapping,
    WithEvents,
    ShouldAutoSize 
{
    use Importable;

    public function query()
    {
        return File::query()->with('level','user');
    }

    public function map($file): array 
    {
        return [
            $file->id,
            $file->name,
            $file->description,
            $file->getLinkById(),
            $file->confirmed ? 'Yes': 'No',
            $file->level ? $file->level->name : 'No Level',
            $file->user ? $file->user->name : 'guest',
            $file->created_at,
            $file->year,
            $file->language,
            $file->file_drive_id,
        ];
    }
    
    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Description',
            'Link',
            'Confirmed',
            'Level Id',
            'Created By',
            'Created At',
            'Year',
            'Language',
            'File Drive Id',
        ];
    }

    public function registerEvents(): array
    {
        return[
            AfterSheet::class =>function(AfterSheet $event) {
                $event->sheet->getStyle('A1:K1')->applyFromArray([
                    'font' => [
                        'bold' => true
                    ],
                ]);
            }
        ];
    }
}
