<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Image;

class ImageController extends Controller
{

    public function create(Request $request, $fileKey, $folderName, $createdBy){
        $imgs = $request->file($fileKey);
        $rtnImageIds = array();

        if(count($imgs) > 0){
            if(is_array($imgs)){
                foreach($imgs as $img){
                    $rtnImageIds[] = $this->save($img,$folderName, $createdBy);
                }

            }else{
                if($imgs){
                    $rtnImageIds[] = $this->save($imgs,$folderName, $createdBy);
                }
            }
        }
        return $rtnImageIds;
    }

    private function save($img,$folderName, $createdBy){
        $path = $img->store($folderName.'/'.date('Ymd'));
        $mImage = new Image;
        $mImage->path = $path;
        $mImage->filename = $img->getClientOriginalName();
        $mImage->created_by = $createdBy;
        $mImage->updated_by = $createdBy;
        $mImage->save();

        return $mImage->getKey();
    }

    public function delete($rDeletingImageId){
        if(is_array($rDeletingImageId)){
            foreach($rDeletingImageId as $id){
                $mImage = new Image;
                $image = $mImage->find($id) ;
                if($image){
                    Storage::delete($image->path);
                    $image->delete();
                }
            }
        }
    }
}
