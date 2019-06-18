<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\load;
use App\User;
use Auth;
class loadController extends Controller
{
    public function store(Request $req) 
    {
        $count = User::where('id',$req->user_id)->value('count');
        $newCount = $count + 1;
        User::where('id',$req->user_id)->update(['count' => $newCount]);
    	return load::create([
    		'active' => $req->active,
    		'code' => $req->code,
    		'tradeName' => $req->tradeName,
    		'paking' => $req->paking,
    		'focus' => $req->focus,
    		'pPrice' => $req->pPrice,
            'ppPrice' => $req->ppPrice,
    		'drugStore' => $req->drugStore,
            'user_id' =>  $req->user_id,
            'companyName' => $req->companyName
    	]);

    }

    public function index(Request $req) 
    {
        return response()->json(load::orderBy('id','decs')->where('user_id',$req->id)->paginate(10));
    }

    public function show($id)
    {
        return response()->json(load::where('id',$id)->firstOrFail());
    }

    public function update(Request $req,$id)
    {
        return load::where('id',$id)->update($req->all());
    }

    public function destroy($id)
    {
        return load::where('id',$id)->delete();
    }
}
