<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

class FileController extends Controller
{
    private $folderName = 'Files';

    public function upload($file)
    {
        if (file_exists($file)) {
            $fileName  =       time().'.'.$file->extension();
            // $img       =       Image::make($file->path());
            $file->move(public_path($this->folderName), $fileName);
            
            return $fileName;
        }else{
            return '';
        }
    }

    public function download($file){
        $path= $this->folderName.'/'. $file;
        return response()->download(public_path($path));
        return Response::download($path);
    }
}
