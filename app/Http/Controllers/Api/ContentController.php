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
          $category=Category::where('name','posts')->pluck('id');
      $data= Content::with(['comments','reactions','photos'])->where('category_id',$category)->get();
      if(count($data)>0){
          return $this->data(200,'posts',PostsResource::collection($data));
      }
      return  $this->error(404,trans('response.Data_Not_Found'));
      }catch (\Exception $e){
          return $this->error(500,$e->getMessage());
      }
  }

    public function getGuidelines()
    {
        try{
            $category=Category::where('name','guidelines')->pluck('id');
            $data= Content::where('category_id',$category)->get();
            if(count($data)>0){
                return $this->data(200,'guidelines',$data);
            }
            return  $this->error(404,trans('response.Data_Not_Found'));
        }catch (\Exception $e){
            return $this->error(500,$e->getMessage());
        }
    }
    public function getVision()
    {
        try{
            $category=Category::where('name','vision')->pluck('id');
            $data= Content::with('photos')->where('category_id',$category)->get();
            if(count($data)>0){
                return $this->data(200,'visions',$data);
            }
            return  $this->error(404,trans('response.Data_Not_Found'));
        }catch (\Exception $e){
            return $this->error(500,$e->getMessage());
        }
    }


}
