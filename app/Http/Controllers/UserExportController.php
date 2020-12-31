<?php

namespace App\Http\Controllers;

use App\Exports\UserExport;
use App\Exports\UserMultiSheetExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;

class UserExportController extends Controller
{
    private $excel;
    public function __construct(Excel $excel)
    {
        $this->middleware('admin');
        $this->excel = $excel;
    }

    public function export()
    {   
        return $this->excel->download(new UserExport, 'users.xlsx');
        // return $this->excel->download(new UserMultiSheetExport(2020), 'users.xlsx');
       
        // return $this->excel->store(new UserExport, 'users.xlsx', 'google'); //to store on Google Drive
    }
}
