<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Http\Controllers\Controller;
use App\Models\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('JWT');
    }
    public function likeIt(Reply $reply){
        $reply->like()->create([
            'user_id' => '1'
        ]);
    }

    public function unlikeIt(Reply $reply)
    {
//        $reply->like()->where('user_id',Auth::user()->id())->first()->delete();
        $reply->like()->where('user_id','1')->first()->delete();
    }
}
