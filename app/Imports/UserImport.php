<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;
use Throwable;

class UserImport implements 
    ToModel, 
    WithHeadingRow,
    SkipsOnError,
    WithValidation,
    SkipsOnFailure,
    // ShouldQueue, // in very large data
    WithChunkReading
{
    use Importable, SkipsErrors, SkipsFailures;

    private $rows = 0;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        ++$this->rows;
        return new User([
            'name' => $row['name'],
            'email' => $row['email'],
            'password' => Hash::make('password'),
        ]);
    }
    public function getRowCount(): int
    {
        return $this->rows;
    }
    
    public function rules(): array
    {
        return [
            '*.email' => ['email', 'unique:users,email'], // or ['*.1'] if dont have the heading
            '*.name' => ['min:5'],
        ];
    }

 
    public function chunkSize(): int
    {
        return 1000;
    }

    /**
     * If you dont need to show the table of failuers make this method empty
     * comment is if you need the failuers table
     */
    // public function onFailure(Failure ...$failure)
    // {
       
    // }
    

}
