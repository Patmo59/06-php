<?php
namespace App\Service;

use phpDocumentor\Reflection\PseudoTypes\False_;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

class Uploader
{
    public function __construct(private SluggerInterface $slugger)
    {
        
    }
    public function uploadFile(UploadedFile $file, string $folder):string|False
    {
        $original = pathinfo($file ->getClientOriginalName(),
        PATHINFO_FILENAME);
        $safe =$this ->slugger ->slug($original);
        $new =$safe."-".uniqid().".".
        $file -> guessClientExtension();
        try{
            $file ->move($folder, $new);
        }catch(FileException $e)
           {
            return false;
           }
        return $new;
    }
}
?>