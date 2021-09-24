<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class QuestionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $now = Carbon::now();
        $created_at = $this->created_at;
        return[
            'title' => $this->title,
            'path' => $this->path,
            'body' => $this->body,
            'replies' => $this->replies,
            'replies_count' => $this->replies->count(),
            'category' =>$this->category->name,
            'created_at' => $now->diffInDays($created_at),
            'user' => $this->user->name,
            'id' => $this->user->id,
        ];
    }
}
