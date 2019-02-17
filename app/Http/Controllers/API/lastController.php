<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\lastsearch;
use Auth;
class lastController extends Controller
{
    public function store($id)
    {
        $count = lastsearch::where('auth',Auth::id())->where('load_id',$id)->count();
        if($count == 1) {
            lastsearch::where('auth',Auth::id())->where('load_id',$id)->delete();
            lastsearch::create([
                'auth' => Auth::id(),
                'load_id' => $id
            ]);
        }else {
            lastsearch::create([
                'auth' => Auth::id(),
                'load_id' => $id
            ]);
        }
    	

    	$count = lastsearch::where('auth',Auth::id())->count();
    	if($count == 5) {
    		$min_id = lastsearch::where('auth')->min();
    		lastsearch::where('id',$min_id)->delete();
    	}
    }

    public function get() {
    	return response()->json(lastsearch::where('auth',Auth::id())->orderBy('id','desc')->get());
    }
}
