<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Level;
use App\Traits\HelpersTrait;
use App\Traits\ServiceGoogleDriveTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class FileController extends Controller
{
    use HelpersTrait;
    use ServiceGoogleDriveTrait;

    public function __construct(){
        $this->middleware('admin', [
                'except'=> [
                    'index',
                    'show',
                    'download',
                    'get_files_by_level',
                    'upload',
                    'uploadToDrive',
                ]
        ]);
        $this->define_google_client();
    }

    public function index(){

        // $files = File::where('confirmed', 1)->paginate(4);
        $files = File::paginate(8);

        return view('files.index')->with('files', $files);
    }

    public function upload(){
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
        $filename = '';
        // $filename .= 'libexams.com-'; //the prefix for the files name
        $filename .= $request->file('pdfile')->getClientOriginalName();
      
        // Store inGoogle Drive folder
        $pathToFile = $request->pdfile->storeAs('', $filename, 'google');

        // store localy
        // $pathToFile = $request->pdfile->storeAs('files', $filename, 'public');
 
        $url = Storage::disk('google')->url($pathToFile);

        $fileId = $this->get_string_between($url, 'id=', '&');

        $file = File::create([
            'name' => $filename,
            'file_drive_id' => $fileId,
            // 'confirmed' => auth()->check() ? 1 : 0,
            'created_by' => auth()->check() ? auth()->user()->id : NULL,
        ]);

        // return $url;
        return redirect()-> route('files.show', ['id' => $file->id]);
    }

    public function show(Request $request){
        
        $file = File::where('id' , $request->id)->first();

        if(!$file){
            return abort(404);
        }

        return view('files.show')->with(['file'=>$file]); 
    }

    public function edit($id){
        $file = File::find($id);
        if(!$file){
            return abort(404);
        }

        return view('files.edit', ['file' => $file]);
    }

    public function update(Request $request){

        $file = File::find($request->id);
        if(!$file){
            return abort(404);
        }

       $validator = Validator::make($request->all(),[
           'name' => '',
           'year' => '',
           'confirmed' => '',
           'description' => '',
       ]);

        $file->name = $request->name;
        $file->year = $request->year;
        $file->confirmed = $request->confirmed == 'on' ? 1 : 0;
        $file->description = $request->description;
  
        $file->level_id = Level::where(['name' => $request->level])->first()->id;
    //   dd(
    //         $file->level
    //     );
        $file->save();

        return redirect()->route('files.show', ['id' => $file->id]);
    }

    public function download(Request $request){
        
        $file = File::where(
            'id' , $request->id
        )->first();

        return view('files.download')->with(['file'=>$file]); 
    }

    
    public function destroy($id){
        $file = File::find($id);
        $this->deleteFileFromDrive($file->file_drive_id);
        $file->delete();
        return redirect()->route('files.index');
    }

    // public function search_form(){
        
    // }

    // public function search(){
        
    // }

    public function get_files_by_level(Request $request){
        $params =  [
            'name' => $request->name,
        ];
        $level = Level::where($params)->first();
        if($level->files){
            $files = $level->files()
            ->paginate(8);
        }else{
            $files = [];
        }
       

        return view('files.index')->with('files', $files);
    }

    public function add_from_local(Request $request){

        $file = File::create([
            'name' => $request->name,
            'file_drive_id' => $request->file_drive_id,
            'created_by' => $request->created_by,
        ]);

        // return $url;
        return redirect()-> route('files.show', ['id' => $file->id]);

    }

    
}
