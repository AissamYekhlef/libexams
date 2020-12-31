<?php

namespace App\Http\Controllers;

use App\Imports\UserImport;
use Illuminate\Http\Request;

class UserImportController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin');
    }

    public function show(){
        return view('dash.users.import');
    }

    public function import(Request $request){

        $file = $request->file('file');
        // $file = $request->file('file')->storeAs('imports','users.xlsx'); // save file locally

        $user_import = new UserImport;
        $user_import->import($file);
        // dd(
        //     $user_import
        // );
        if ($user_import->failures()->isNotEmpty()) {
            return back()->withFailures($user_import->failures())
                        ->with('rows_count' , $user_import->getRowCount());
        }
            
    
        return back()->withStatus('Excel file imported successful');
    }
}
