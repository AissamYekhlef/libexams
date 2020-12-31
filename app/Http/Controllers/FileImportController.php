<?php

namespace App\Http\Controllers;

use App\Imports\FileImport;
use App\Models\File;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;

class FileImportController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function show()
    {
        return view('files.import');
    }

    public function import(Request $request)
    {
        $file = $request->file('file');
        // $file = $request->file('file')->storeAs('imports','users.xlsx'); // save file locally

        $file_import = new FileImport;
    
        // try{
            $file_import->import($file);
        
        
        
        // Excel::load($file, function($reader){
        //     dd(
        //         $reader->getTitle()
        //     );
        // });
        

        // dd(
        //     $file_import->failures()
        // );

        if ($file_import->failures()->isNotEmpty()) {
            return back()->withFailures($file_import->failures())
                        ->with('rows_count' , $file_import->getRowCount());
        }

        if ($file_import->errors()->isNotEmpty()) {
            return back()->withErrors($file_import->errors());
        }        
    
        return back()->withStatus('Excel file imported successful');
    }
}
