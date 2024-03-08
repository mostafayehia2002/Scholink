<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MaterialResource;
use App\Models\Material;
use App\Traits\GeneralResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MaterialController extends Controller
{
    use GeneralResponse;
public function getMaterials(Request $request)
{
    try {
        $validate=Validator::make($request->all(),[
            'subject_id'=>'required|exists:subjects,id',
             'type'=>'in:lesson,exam,video',
        ]);
        if ($validate->fails()) {
            return $this->error(422,$validate->errors());
        }
        $student=auth('student')->user();
        $data=Material::with('attachments')
            ->where('class_id',$student->class_id)
            ->where('subject_id',$request->subject_id)
            ->where(function ($query) use($request){
            if($request->has('type')){
                $query->where('type',$request->type);
            }
            })->orderBy('created_at','desc')
            ->get();
        if(count($data)<0){
            return $this->error(404,trans('response.Data_Not_Found'));
        }
        return $this->data(200, 'materials',MaterialResource::collection($data));
    }catch (\Exception $e){
        return  $this->error(500,$e->getMessage());
    }

}
}
