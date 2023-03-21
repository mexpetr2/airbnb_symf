<?php 


namespace App\Services;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;




class UploadFiles extends AbstractController{
    public function renameFile($file){
        $fileName = bin2hex(random_bytes(10)).''.uniqid().''.time().'.'.$file->guessExtension();
        return $fileName;
    }
    public function moveFile($file){
        $fileName = $this->renameFile($file);

        $file->move($this->getParameter('upload_dir'),$fileName);

        return 'assets/images/appartment/'.$fileName;
    }
}

?>