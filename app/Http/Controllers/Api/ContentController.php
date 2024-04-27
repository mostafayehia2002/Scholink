<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostsResource;
use App\Models\Category;
use App\Models\Content;
use App\Traits\GeneralResponse;

class ContentController extends Controller
{
    use GeneralResponse;
    //
  public function getPosts()
  {
      try{
          $category=Category::whereJsonContains('name',['en'=>'posts'])->pluck('id');
      $data= Content::with(['comments','reactions','photos'])->where('category_id',$category)->orderBy('created_at','desc')->get();
      if(count($data)>0){
          return $this->data(200,'posts',PostsResource::collection($data));
      }
      return  $this->errorMessage(404,trans('response.Data_Not_Found'));
      }catch (\Exception $e){
          return $this->errorMessage(500,$e->getMessage());
      }
  }

    public function getGuidelines()
    {
        try{
            $category=Category::whereJsonContains('name',['en'=>'guidelines'])->pluck('id');
            $data= Content::where('category_id',$category)->orderBy('created_at','desc')->get();
            if(count($data)>0){
                return $this->data(200,'guidelines',$data);
            }
            return  $this->errorMessage(404,trans('response.Data_Not_Found'));
        }catch (\Exception $e){
            return $this->errorMessage(500,$e->getMessage());
        }
    }
    public function getVision()
    {
        try{
            $category=Category::whereJsonContains('name',['en'=>'visions'])->pluck('id');
            $data= Content::with('photos')->where('category_id',$category)->orderBy('created_at','desc')->get();
            if(count($data)>0){
                return $this->data(200,'visions',$data);
            }
            return  $this->errorMessage(404,trans('response.Data_Not_Found'));
        }catch (\Exception $e){
            return $this->errorMessage(500,$e->getMessage());
        }
    }


}
