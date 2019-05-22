<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\load;
use App\active;
class searchController extends Controller
{
    public function search_byName(Request $request)
    {
    	return response()->json(load::where('tradeName','like','%'.$request->search.'%')->take(10)->get());
    }

    public function fullSearch(Request $request,$type)
    {
    	if($type == 'name')
    	{
    		return response()->json(load::where('tradeName','like','%'.$request->search.'%')->take(10)->get());
    	}

    	if($type == 'active')
    	{
    		return response()->json(load::where('active','like','%'.$request->search.'%')->take(10)->get());
    	}
    	if($type == 'store')
    	{
    		return response()->json(load::where('drugStore','like','%'.$request->search.'%')->take(10)->get());
    	}
    }

    public function searchActive(Request $req) {
        return response()->json(active::where('active','like','%'.$req->search.'%')->take(10)->get());
    }
}
