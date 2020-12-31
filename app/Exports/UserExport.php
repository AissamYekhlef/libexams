<?php

namespace App\Exports;

use App\Models\User;
use DateTime;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;

class UserExport implements 
    // FromCollection, 
    ShouldAutoSize, 
    WithMapping, 
    WithHeadings,
    WithEvents,
    WithTitle,
    FromQuery
{
    use Exportable;

    private $year;
    private $month;

    public function __construct()
    {
        $arguments = func_get_args();
        $numberOfArguments = func_num_args();

        if (method_exists($this, $function = '__construct'.$numberOfArguments)) {
            call_user_func_array(array($this, $function), $arguments);
        }
    }

    public function __construct2(int $year, int $month)
    {
        $this->year = $year;
        $this->month = $month;
    }


    // public function collection()
    // {
    //     return User::with('files')->get();
    //     // return new Collection([
    //     //     ['issam', 'issam@mobidal.com']
    //     // ]);
    // }

    public function query()
    {
        if(isset($this->year) && isset($this->month)){
            return User::query()->with('files', 'level')
                            ->whereYear('created_at', $this->year)
                            ->whereMonth('created_at', $this->month);
        }else{
            return User::query()->with('files', 'level');
        }
        
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
        return [
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
                $event->sheet->getStyle('A1:F1')->applyFromArray([
                    'font' => [
                        'bold' => true
                    ],
                ]);
            }
        ];
    }

    public function title(): string
    {
        if(isset($this->year) && isset($this->month)){
            return DateTime::createFromFormat('!m', $this->month)->format('F');
        }else{
            return 'All Users';
        }
    }


    
}
