<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
//    protected $fillable = ['title','slug','body','category_id','user_id'];

    protected $guarded = [];

    protected $with = ['replies'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function replies(){
        return $this->hasMany(Reply::class);
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function getPathAttribute(){
        return "question/$this->slug";
    }

    use HasFactory;
}
