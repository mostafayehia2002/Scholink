<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AnnouncementsResource;
use App\Http\Resources\NewsResource;
use App\Models\Category;
use App\Models\SubCategory;
use App\Traits\GeneralResponse;
use Illuminate\Http\Request;
use function Laravel\Prompts\text;


class SubCategoryController extends Controller
{
    use GeneralResponse;

    public function getNews(Request $request)
    {
        try {
            $data=SubCategory::with('news')->where(function ($query) use ($request) {
                if($request->has('id') && SubCategory::find($request->id) ){
                    $query->where('id',$request->id);
                }
            })->where(function ($query) use ($request){
               $news=Category::where('name','news')->first();
                $query->where('category_id',$news->id);
            })->get();

            if($data->count()<0){
                return $this->error(404,trans('response.Data_Not_Found'));
            }


            return $this->data(200, 'categories',NewsResource::collection($data));
        }catch (\Exception $e){
            return  $this->error(500,$e->getMessage());
        }
    }

    public function getAnnouncements(Request $request)
    {
        try {
            $announcement=Category::where('name','announcements')->first();
            $data=SubCategory::with('announcements')->where(function ($query) use ($request) {
                if ($request->has('id') && SubCategory::find($request->id)){
                    $query->where('id',$request->id);
                }
            })->where('category_id',$announcement->id)->get();
            if($data->count()<0){
                return $this->error(404,trans('response.Data_Not_Found'));
            }
            return $this->data(200, 'categories',AnnouncementsResource::collection($data) );

        }catch (\Exception $e){
            return  $this->error(500,$e->getMessage());
        }
    }
}
