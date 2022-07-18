<?php

    namespace PHPMVC\LIBRARY;

    use Exception;

    class FileUpload
    {
        private $name;
        private $type;
        private $size;
        private $tmpPath;
        private $error;

        private $fileExtension;

        private $allowedExtension = [ 'jpg', 'jpeg' , 'png', 'gif', 'pdf', 'doc', 'docx', 'xls' , 'svg' ];

        public function __construct(array $file)
        {
            $this->name = $file['name'];
            $this->type = $file['type'];
            $this->size = $file['size'];
            $this->tmpPath = $file['tmp_name'];
            $this->error = $file['error'];
            $this->name();
        }
        

        public function name()
        {
            preg_match_all('/([a-z]{1,4})$/i' , $this->name, $m );
            $this->fileExtension = $m[0][0] ;
            $name = substr(strtolower(base64_encode($this->name.APP_SALT)),0,30);
            $name = preg_replace('/(\w{6})/i','$1_',$name);
            $name = rtrim($name,'_');
            $this->name = $name;
            return $name ;
        }

        private function isAllowedType()
        {
            return in_array($this->fileExtension, $this->allowedExtension) ;
        }

        private function isSizeNotAcceptable()
        {
            preg_match_all('/(\d+)([MG])$/i',MAX_FILE_SIZE_ALLOWED,$matches);
            $maxFileSizeToUpload = $matches[1][0] ;
            $sizeUnit =  $matches[2][0];
            $currentFileSize = ($sizeUnit == 'M') ? ($this->size / 1024 / 1024) : ($this->size / 1024 / 1024 / 1024) ;
            $currentFileSize = ceil($currentFileSize);  
            return(int) $currentFileSize > (int) $maxFileSizeToUpload ;
        }

        private function isImage()
        {
            return preg_match('/image/i', $this->type);
        }

        public function getFileName()
        {
            return $this->name .'.'. $this->fileExtension ;
        }

        public function upload()
        {
            if ($this->error != 0) {
                throw new \Exception('Sorry file didn\'t upload Successfully ');
            }
            elseif(!$this->isAllowedType()){
                throw new \Exception('Sorry files of '.$this->fileExtension.' are not Allowed');
            }
            elseif ($this->isSizeNotAcceptable()) {
                throw new \Exception('Sorry file Size exceeds the maximum allowed size'.$this->fileExtension.' are not Allowed');
            }else {
                ### -> Make sure that the folder has write permissions to avoid errors
                $storageFolder = $this->isImage() ? IMAGES_UPLOAD_STORAGE : DOCUMENTS_UPLOAD_STORAGE ;
                if (is_writable($storageFolder)) {
                    move_uploaded_file($this->tmpPath , $storageFolder . DS . $this->getFileName()) ;
                }
                else {
                    throw new \Exception('Sorry, the destination folder is not writable ');
                }
            }
            return $this ;
        }
    }
    