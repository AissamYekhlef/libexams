<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Traits\HelpersTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class FileController extends Controller
{
    use HelpersTrait;

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
            'pdfile' => 'required'
        ]);

        if($validator->fails()){
            return back()->with([
                'errors' => $validator->errors()
            ]);
        }
        $filename = $request->file('pdfile')->getClientOriginalName();
      
        // Store inGoogle Drive folder
        $pathToFile = $request->pdfile->storeAs(config('folderId'), $filename, 'google');

        // store localy
        // $pathToFile = $request->pdfile->storeAs('files', $filename, 'public');

        $url = Storage::disk('google')->url($pathToFile);

        $fileId = $this->get_string_between($url, 'id=', '&');

        // TODO
        // create a new File model ans save it with fileId 
        $file = File::create([
            'name' => $filename,
            'file_drive_id' => $fileId,
            'confirmed' => auth()->check() ? 1 : 0,
            'created_by' => auth()->check() ? auth()->user()->id : NULL,
        ]);

        // return $url;
        return redirect()-> route('files.show', ['id' => $file->id]);
    }

    public function show(Request $request){
        
        $file = File::where(
            'id' , $request->id
        )->first();

        return view('files.show')->with(['file'=>$file]); 
    }


    
}
