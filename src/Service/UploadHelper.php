<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class UploadHelper
{
    private string $dossierUpload;

    public function __construct (string $dossierUpload){
        $this->dossierUpload = $dossierUpload;
    }

    public function upload(UploadedFile $fichier): string
    {

        $file = md5(uniqid()) . "." . $fichier->guessExtension();
        $fichier->move($this->dossierUpload . "/uploads", $file);
        return $file;
    }
}
