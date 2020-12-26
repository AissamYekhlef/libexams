<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;

class UserExport implements 
    // FromCollection, 
    ShouldAutoSize, 
    WithMapping, 
    WithHeadings,
    WithEvents,
    FromQuery
{
    use Exportable;


    // public function collection()
    // {
    //     return User::with('files')->get();
    //     // return new Collection([
    //     //     ['issam', 'issam@mobidal.com']
    //     // ]);
    // }

    public function query()
    {
        return User::query()->with('files', 'level');
    }

    public function map($user): array
    {
        return [
            $user->id,
            $user->name,
            $user->email,
            $user->level ? $user->level->name : '',
            $user->files->count(),
            $user->created_at,
        ];
    }

    public function headings():array
    {
        return[
            'ID',
            'Name',
            'Email',
            'Level',
            'Files Count',
            'Created At',
        ];
    }

    public function registerEvents(): array
    {
        return[
            AfterSheet::class =>function(AfterSheet $event) {
                $event->sheet->getStyle('A1:E1')->applyFromArray([
                    'font' => [
                        'bold' => true
                    ],
                ]);
            }
        ];
    }
    
}
