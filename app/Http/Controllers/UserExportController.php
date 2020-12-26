<?php

namespace App\Http\Controllers;

use App\Exports\UserExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;

class UserExportController extends Controller
{
    private $excel;
    public function __construct(Excel $excel)
    {
        $this->excel = $excel;
    }

    public function export()
    {
        return $this->excel->download(new UserExport, 'users.xlsx');
        // return $this->excel->store(new UserExport, 'users.xlsx', 'google'); //to store on Google Drive
    }
}
