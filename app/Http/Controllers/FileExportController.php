<?php

namespace App\Http\Controllers;

use App\Exports\FileExport;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;

class FileExportController extends Controller
{
    private $excel;
    public function __construct(Excel $excel){
        $this->middleware('admin');
        $this->excel = $excel;
    }

    public function export()
    {
        // $this->excel->store(new FileExport, 'libexams_files.xlsx', 'google');
       return  $this->excel->download(new FileExport, 'libexams_files ' . Carbon::now() . '.xlsx');
    } 
}
