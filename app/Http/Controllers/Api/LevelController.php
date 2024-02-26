<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\LevelResource;
use App\Models\Level;
use App\Traits\GeneralResponse;

class LevelController extends Controller
{
    use GeneralResponse;
    public function getLevels()
    {
        try{
         $student=auth('student')->user();
        $levels=Level::where('id','<=',$student->classe->level_id)->get();
        if(count($levels)<0){
            return $this->error(404,trans('response.Data_Not_Found'));
        }
         return $this->data(200,'data',LevelResource::collection($levels));
        }catch(\Exception $e){
            return $this->error(500,$e->getMessage());
        }
    }
}
