<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UploadController extends Controller
{

    public function index(){
        return view('files.upload');
    }
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function uploadToDrive(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'file' => 'required'
        ]);

        if($validator->fails()){
            return back()->with([
                'errors' => $validator->errors()
            ]);
        }
        // Store inGoogle Drive older
        Storage::disk('google')->put( $request->file, $request->file);
        // store localy
        //Storage::disk('local')->put('public/files/' . $request->file, $request->file);
        dd("Added");
    }
}
