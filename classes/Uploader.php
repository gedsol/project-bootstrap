<?php
/*
 *
 */
require_once 'Database.php';
class Uploader {
    private $uploadDir = '/var/www/images/';
    private $path = '/images/';
    private $uploadFile;
    private $name;
    private $description;
    private $taken;
    private $tmp_name;
    private $type;
    private $error;
    private $allowedTypes=array('image/jpeg','image/gif','image/png');

    public function __construct(){
        if(!count($_FILES)){
            throw new Exception('Invalid number of file upload parameters.');
        }
        foreach($_FILES['file'] as $key=>$value){
            $this->{$key}=$value;
        }
        $this->path = $this->path.$this->name;
        if(!in_array($this->type,$this->allowedTypes)){
            throw new Exception('Invalid MIME type of target file.');
        }
        $this->uploadFile=$this->uploadDir.basename($this->name);
    }
    public function upload(){
        if(move_uploaded_file($this->tmp_name,$this->uploadFile)){
            $db = new Database();
            $db->add_image($this->path, $this->name, $this->taken, $this->description);
            return true;
        }
        switch($this->error){
            case 1:
                throw new Exception('Target file exceeds maximum allowed size.');
                break;
            case 2:
                throw new Exception('Target file exceeds the MAX_FILE_SIZE value specified on the upload form.');
                break;
            case 3:
                throw new Exception('Target file was not uploaded completely.');
                break;
            case 4:
                throw new Exception('No target file was uploaded.');
                break;
            case 6:
                throw new Exception('Missing a temporary folder.');
                break;
            case 7:
                throw new Exception('Failed to write target file to disk.');
                break;
            case 8:
                throw new Exception('File upload stopped by extension.');
                break;
        }
    }

}