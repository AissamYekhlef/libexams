<?php

namespace App\Traits;

use Exception;
use Google_Client;
use Hypweb\Flysystem\GoogleDrive\GoogleDriveAdapter;

trait ServiceGoogleDriveTriat {
    
    public $google_disk = 'filesystems.disks.google';
    public $drive_folder_id =  'folderId';

    private $service ;
    private $adapter ;

    public function __construct(){

        $client = new Google_Client();
        $client->setClientId( config( $this->google_disk . '.' .  'clientId'));
        $client->setClientSecret(config( $this->google_disk . '.' .  'clientSecret'));
        $client->refreshToken(config(  $this->google_disk . '.' .  'refreshToken'));

        $this->service = new \Google_Service_Drive($client);
        $this->adapter = new GoogleDriveAdapter($this->service, config(  $this->google_disk . '.' .  'folderId'));
    }

    public function getGoogleService(){
        return $this->service;
    }
    public function getGoogleAdapter(){
        return $this->adapter;
    }

    public function deleteFileFromDrive($fileId) {
        try {
          $service = $this->getGoogleService();  
          $service->files->delete($fileId);
        } catch (Exception $e) {
          print "An error occurred: " . $e->getMessage();
        }
    }
}