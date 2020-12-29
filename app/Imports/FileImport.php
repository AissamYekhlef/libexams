<?php

namespace App\Imports;

use App\Models\File;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;

class FileImport implements 
    ToModel,
    WithValidation,
    SkipsOnError,
    SkipsOnFailure,
    WithHeadingRow
{
    use Importable, 
        SkipsErrors, 
        SkipsFailures;
    
    private $rows = 0; 

    public function model(array $row)
    {
        ++$this->rows;  
        return new File([
            'name' => $row['name'],
            'description' => $row['description'],
            'confirmed' => $row['confirmed'] == 'Yes' ? 1 : 0,
            'year' => $row['year'],
            // 'level_id' => $row['level_id'],
            'language' => $row['language'],
            'file_drive_id' => $row['file_drive_id'], 
        ]);      
    }

    public function getRowCount(): int
    {
        return $this->rows;
    }

    public function rules(): array
    {
        return [
            '*.file_drive_id' => ['required', 'min:10', 'unique:files,file_drive_id'], // or ['*.1'] if dont have the heading
            '*.name' => ['required', 'min:5'],
            // '*.level_id' => ['integer'],
        ];
    }

    /**
     * If you dont need to show the table of failuers make this method empty
     * comment is if you need the failuers table
     */
    // public function onFailure(Failure ...$failure)
    // {
       
    // }

}
