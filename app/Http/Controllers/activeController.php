<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\cons;
use App\load;
use App\active;
use App\tb;
use App\c_image;
use App\w_image;
class activeController extends Controller
{
    public function store(Request $req)
    {
    	return active::create([
    		'active' => $req->active,
    		'couns' => $req->couns,
    		'warn'=> $req->warn,
    		'count' => $req->cont
    	]);
    }

    public function search(Request $req)
    {
    	return response()->json(active::where('active','like','%'.$req->search.'%')->take(4)->get());
    }

    public function rep()
    {
        $cons = cons::get();
        foreach ($cons as $k) {
           active::create([
            'active' => $k->active,
            'couns' => $k->couns,
            'warn'=> $k->warn,
            'count' => $k->cont
        ]); 
        }
    }

    public function c_i(Request $req) {
        $w_image = tb::get();
        foreach ($w_image as $k) {
            w_image::create([
                'title' => $k->title,
                'text' => $k->text,
                'number' => $k->number,
            ]);
        }
    }
}
