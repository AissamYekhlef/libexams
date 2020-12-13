<?php

namespace App\Http\Controllers;

use Google_Client;
use Google_Service_Drive_DriveFile;
use Hypweb\Flysystem\GoogleDrive\GoogleDriveAdapter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Response;

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


        $client = new Google_Client(['verify' => false]);
        $client->setClientId(config('clientId'));
        $client->setClientSecret(config('clientSecret'));
        $client->refreshToken(config('refreshToken'));

        $service = new \Google_Service_Drive($client);
    
        // This is uploading a file directly, with no metadata associated.
        $file = new Google_Service_Drive_DriveFile();
        $result = $service->files->create(
            $file,
            array(
                'data' => file_get_contents($request->file('pdfile')),
                'mimeType' => 'application/octet-stream',
                'uploadType' => 'media'
            )
        );

        // $adapter = new GoogleDriveAdapter($service, config('folderId'));
        

        // store localy
        // $pathToFile = $request->pdfile->storeAs('files', $filename, 'public');

        return view('files.show')->with(['fileId'=>$result->id]);
    }
}
