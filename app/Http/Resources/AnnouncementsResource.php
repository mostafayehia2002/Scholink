<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AnnouncementsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    private $Announcements=[];
    public function toArray(Request $request): array
    {
        $i=0;
        foreach ($this->announcements as $announcement){
            $this->Announcements[$i++]=['price'=>$announcement->price,'photo'=>asset($announcement->photo),'created_at'=>$announcement->created_at,'updated_at'=>$announcement->updated_at];
        }
        return [
           'id' =>$this->id,
            'name'=>$this->name,
            'created_at'=>$this->created_at,
            'updated_at'=>$this->updated_at,
            'announcements'=>$this->Announcements
        ];
    }
}
