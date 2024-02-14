<?php

namespace App\Http\Resources;

use App\Models\Content;
use App\Models\News;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class NewsResource extends JsonResource
{
    private $News=[];
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $i=0;
        foreach ($this->news as $new){
           $id= $new->id;
           $content=$new->content;
          $image= Photo::where('photoble_id',$id)->where('photoble_type','App\Models\News')->get();
            $this->News[$i++]=['content'=>$content,'photos'=>$image,'created_at'=>$new->created_at,'updated_at'=>$new->updated_at];
        }
        return [
            "category_id"=>$this->id,
            "name"=>$this->name,
            "photo"=> $this->photo,
            "created_at"=>$this->created_at,
            "updated_at"=>$this->updated_at,
            "news"=>$this->News,
        ];
    }
}
